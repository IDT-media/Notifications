<?php
#-------------------------------------------------------------------------
# Module: Notifications
# Version: 1.1
#-------------------------------------------------------------------------
#
# Copyright:
#
# IDT Media - Goran Ilic & Tapio Löytty
# Web: www.idt-media.com
# Email: hi@idt-media.com
#
#
# Authors:
#
# Goran Ilic, <ja@ich-mach-das.at>
# Web: www.ich-mach-das.at
# 
# Tapio Löytty, <tapsa@orange-media.fi>
# Web: www.orange-media.fi
#
# License:
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------

class Notifications extends CMSModule
{
	#---------------------
	# Magic methods
	#---------------------		
	
	public function __construct()
	{	
		spl_autoload_register(array(&$this, '_autoloader'));
	
		parent::__construct();	
	}
	
	#---------------------
	# Internal autoloader
	#---------------------	

	private final function _autoloader($classname)
	{	
		$parts = explode('\\', $classname);
		$classname = end($parts);
	
		$fn = $this->GetModulePath()."/lib/class.{$classname}.php";
		if(file_exists($fn)) {
		
			require_once($fn);
		}	
	}		
	
	#---------------------
	# Module API methods
	#---------------------	

	public function GetName()
	{
		return get_class($this);
	}

	public function GetFriendlyName()
	{
		return $this->Lang('modulename');
	}

	public function GetDependencies()
	{
		return array('CMSMailer'=>'2.0.2');
	}

	public function AllowAutoInstall()
	{
		return false;
	}

	public function AllowAutoUpgrade()
	{
		return false;
	}

	public function IsPluginModule()
	{
		return true;
	}

	public function HasAdmin()
	{
		return true;
	}

	public function GetVersion()
	{
		return '1.2';
	}

	public function MinimumCMSVersion()
	{
		return '1.11';
	}

	public function GetAdminDescription()
	{
		return $this->Lang('module_description');
	}

	public function VisibleToAdminUser()
	{
		return $this->CheckPermission($this->GetName() . '_manage_notifications');
	}

	public function InstallPostMessage()
	{
		return $this->Lang('postinstall');
	}

	public function UninstallPostMessage()
	{
		return $this->Lang('postuninstall');
	}

	public function UninstallPreMessage()
	{
		return $this->Lang('preuninstall');
	}
	
	function GetEventDescription( $eventname )
	{
		return $this->Lang('eventdesc_' . $eventname);
	}

	function GetEventHelp( $eventname )
	{
		return $this->Lang('eventhelp_' . $eventname);
	}		

	public function GetAdminSection()
	{
		return $this->GetPreference('adminsection', 'extensions');
	}

	public function GetAuthor()
	{
		return 'IDT Media Team';
	}

	public function GetAuthorEmail()
	{
		return 'hi@idt-media.com';
	}
	
	public function LazyLoadFrontend()
	{
		return true;
	}  

	public function LazyLoadAdmin()
	{
		return true;
	}	
	
	public function InitializeFrontend()
	{
		$this->RestrictUnknownParams();
	
		// Set allowed parameters
		$this->SetParameterType('notification', CLEAN_INT);
		$this->SetParameterType(CLEAN_REGEXP.'/var_.*/',CLEAN_STRING);
	}
	
	public function InitializeAdmin()
	{
		// parameters that can be called in the module tag
		$this->CreateParameter('notification', '', $this->Lang('help_param_notification'));	
		$this->CreateParameter('var_*', '', $this->Lang('help_param_var_'));	
	}		
	
	public function GetChangeLog()
	{
		return @file_get_contents(dirname(__FILE__).'/changelog.html');
	}

	public function GetHelp()
	{
		$smarty = cmsms()->GetSmarty();
		
		$smarty->assign('module_path', $this->GetModuleURLPath());
		$smarty->assign('idt_module_help', Notifications\IDT::getModuleHelp());

		$smarty->assign('mod', $this);

		return $this->ProcessTemplate('help.tpl');
	}		
	
    public function GetHeaderHTML()
    {
        return <<<EOT
<link type="text/css" rel="stylesheet" href="{$this->GetModuleURLPath()}/lib/css/jquery.tagit.css" />
<link type="text/css" rel="stylesheet" href="{$this->GetModuleURLPath()}/lib/css/style.css" />
<script type="text/javascript" src="{$this->GetModuleURLPath()}/lib/js/tag-it.min.js"></script>
<script type="text/javascript" src="{$this->GetModuleURLPath()}/lib/js/functions.js"></script>
EOT;
    }	

	public function DoAction($name,$id,$params,$returnid='')
	{
		$smarty = cmsms()->GetSmarty();

		$smarty->assignByRef($this->GetName(), $this);
		$smarty->assign('actionid', $id);
		$smarty->assign('returnid', $returnid);
		
		parent::DoAction($name,$id,$params,$returnid);
	}

	public function DoEvent($originator, $eventname, &$params)
	{
		$items = $this->GetItems(false); // <- Do not load Overload properties
		foreach($items as $item) {
	
			$itemevents = ntfs_handler::LoadEvents($item); // <- Gotta load directly from handler, cause $this->events dosen't exists in this instance.
			foreach($itemevents as $eventid) {
	
				$event = $this->GetEventById($eventid);
				if ($originator == $event['originator'] && $eventname == $event['event_name']) {

					// Email sending & object altering goes here
					$this->EvalCode($item, $params, $originator, $eventname);
					$this->SendNotification($item, $params); // <- Add some sort of error reportit, audit or something.	
				}		
			}
		}
	}

	#---------------------
	# Manipulation methods
	#---------------------
	
	protected function EvalCode(ntfsNotification &$notification, &$params, $originator = null, $eventname = null)
	{
		$db = cmsms()->GetDb();

		$query = "SELECT code FROM ".cms_db_prefix()."module_notifications_items WHERE id = ?";
		$code = $db->GetOne($query, array($notification->id));
		
		if($code) 
			@eval($code);
	}	
	
	protected function TestCode($code)
	{		
		if(is_null(@eval($code)))
			return true;
			
		return FALSE;
	}		
	
	#---------------------
	# Item methods
	#--------------------- 	
	
	public function GetItems($full = true)
	{
		$db = cmsms()->GetDb();

		$result = array();

		$query = "SELECT id FROM ".cms_db_prefix()."module_notifications_items ORDER BY id DESC";
		$dbresult = $db->Execute($query);

		while ($dbresult && $row = $dbresult->FetchRow())
		{
			$obj = new ntfsNotification;
			ntfs_handler::Load($obj, $row['id'], $full);	
			
			$result[] = $obj;
		}

		return $result;
	}
	
	#---------------------
	# Event methods
	#---------------------  	
	
	public function GetEvents()
	{
		return Events::ListEvents();
	}
	
	public function GetModuleEvents()
	{
		$db = cmsms()->GetDb();

		$result = array();

		$query = "SELECT DISTINCT event_id FROM ".cms_db_prefix()."module_notifications_events";
		$dbresult = $db->Execute($query);

		while ($dbresult && $row = $dbresult->FetchRow()) {

			$result[] = $row['event_id'];		
		}

		return $result;
	}
	
	public function GetEventById($id)
	{
		$events = $this->GetEvents();

		foreach($events as $event) {
		
			if($event['event_id'] == $id) {
			
				return $event;
			}
		}			

		return false;
	}
	
	public function UpdateEventHandlers(ntfsNotification &$obj)
	{	
		$events = $this->GetEvents();
		$mod_events = $this->GetModuleEvents();
		
		// Remove all events that aint neccery for module
		foreach($events as $event) {
		
			if(!in_array($event['event_id'], $mod_events)) {
			
				$this->RemoveEventHandler($event['originator'], $event['event_name']);
			}
		}
		
		// Add new events from object
		foreach($obj->events as $eventid) {
			
			if(in_array($eventid, $mod_events)) { // <- Wtf this shouldn't be working like this, see into it at some point.
			
				$event = $this->GetEventById($eventid);
				$this->AddEventHandler($event['originator'], $event['event_name'], false);
			}
		}
	}
	
	#---------------------
	# Mailer methods
	#---------------------	
	
	public function SendNotification(ntfsNotification $obj, $params)
	{
		$mail = cmsms()->GetModuleInstance('CMSMailer');
		if(!is_object($mail)) 
			die('CMSMailer not installed, please install CMSMailer in order to continue.');
		
		$result = true;
		
		$smarty = cmsms()->GetSmarty();
		$smarty->assign('notification', $obj);
		$smarty->assign('params', $params);

		$subject 	= $smarty->fetch('string:' . $obj->subject);
		$html 		= $smarty->fetch('string:' . $obj->message_html);
		$plain	 	= $smarty->fetch('string:' . $obj->message_plain);

		$mail->AddReplyTo($obj->from_address);
		$mail->SetFrom($obj->from_address);
		$mail->SetSubject($subject);
		
		foreach((array)$obj->to_address as $address) {
			
			$mail->AddAddress($address);		
		}
		
		if($obj->GetAttribute('mode', 'html') == 'html') {
		
			$mail->IsHTML(true);		
			$mail->SetBody($html);
			$mail->SetAltBody($plain);
		}
		else {
		
			$mail->IsHTML(false);		
			$mail->SetBody($plain);
		}

		if(!$mail->Send()) {

			$result = $this->Lang('error_sendfailed', $mail->ErrorInfo);
			$this->Audit($obj->id, $this->GetFriendlyName(), $result);
		} 

		Events::SendEvent($this->GetName(), 'PostSendNotification', array('mail_object' => &$mail));
		
		$mail->reset();
	
		return $result;
	}	

} // end of class

?>