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

if (!is_object(cmsms())) exit;

#---------------------
# Init params
#---------------------

if(isset($params['cancel'])) {

	$this->Redirect($id, 'defaultadmin', $returnid);
}

$nid 					= (int)ntfs_utils::init_var('nid', $params, -1);
$name 					= (string)ntfs_utils::init_var('name', $params, '');
$description 			= (string)ntfs_utils::init_var('description', $params, '');
$subject 				= (string)ntfs_utils::init_var('subject', $params, '');
$to_address 			= (array)ntfs_utils::init_var('to_address', $params, array());
$from_address 			= (string)ntfs_utils::init_var('from_address', $params, '');
$message_html 			= (string)ntfs_utils::init_var('message_html', $params, '');
$message_plain			= (string)ntfs_utils::init_var('message_plain', $params, '');
$code 					= (string)ntfs_utils::init_var('code', $params, '');
$seleventsarray 		= (array)ntfs_utils::init_var('events', $params, array());
$attributes		 		= (array)ntfs_utils::init_var('attributes', $params, array());

#---------------------
# Init object
#---------------------

$obj = new ntfsNotification;
ntfs_handler::Load($obj, $nid);

#---------------------
# Init events
#---------------------

$events = $this->GetEvents();
$eventsarray = array();
foreach($events as $event) {

	$key = $event['originator'].'.'.$event['event_name'];
	$eventsarray[$key] = $event['event_id'];
}

#---------------------
# Fill attributes
#---------------------

if(count($attributes) > 0) {

	foreach($attributes as $key => $value) {
	
		$obj->SetAttribute($key, $value);
	}
}

#---------------------
# Submit or Apply
#---------------------

if(isset($params['submit']) || isset($params['apply'])) {

	$errors = array();
	
	if(empty($name)) {
	
		$errors[] = $this->Lang('error_fieldempty', $this->Lang('name'));
	}
	
	if(!$this->TestCode($code) && !empty($code)) {
	
		$errors[] = $this->Lang('error_parse_error');
	}	

	if(empty($errors)) {
	
		$obj->name 			= $name;
		$obj->description 	= $description;
		$obj->subject 		= $subject;
		$obj->from_address	= $from_address;
		$obj->to_address 	= $to_address;
		$obj->message_html 	= $message_html;
		$obj->message_plain = $message_plain;
		$obj->events 		= $seleventsarray;
		
		// Advanced tab variables
		if($this->CheckPermission($this->GetName() . '_advanced_usage')) {
			
			$obj->code	 	= $code;
		}
		
		// Save object
		ntfs_handler::Save($obj);
		
		// Update handlers
		$this->UpdateEventHandlers($obj);
		
		if(isset($params['submit'])) {
		
			$parms = array('tab_message'=>'itemdeleted', 'active_tab' => 'notifications');
			$this->Redirect($id, 'defaultadmin', $returnid, array('active_tab' => 'notifications', 'tab_message' => 'itemsaved'));
		} else {
		
			echo $this->ShowMessage($this->Lang('itemsaved'));
		}
	} 
		
} elseif($obj->id > 0) {

	$name 				= $obj->name;
	$description 		= $obj->description ;
	$subject 			= $obj->subject;
	$to_address 		= $obj->to_address;
	$from_address 		= $obj->from_address;
	$message_html 		= $obj->message_html;
	$message_plain		= $obj->message_plain;
	$seleventsarray		= $obj->events;
	$code 				= $obj->code; // <- Loading even if no permission
}

#---------------------
# Message control
#---------------------

if(!empty($errors)) {

	foreach($errors as $error) {
	
		echo $this->ShowErrors($error);
	}
}

#---------------------
# Smarty processing
#---------------------

if(isset($obj))
	$smarty->assign('notification', $obj);

$smarty->assign('startform', $this->CreateFormStart ($id, 'admin_notification_addedit', $returnid, 'post', 'multipart/form-data', false, '', $params));
$smarty->assign('endform', $this->CreateFormEnd ());

$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', $this->Lang('submit')));
$smarty->assign('apply', $this->CreateInputSubmit($id, 'apply', lang('apply')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', $this->Lang('cancel')));

$smarty->assign('input_name',$this->CreateInputText($id, 'name', $name, 50));
$smarty->assign('input_description',$this->CreateInputText($id, 'description', $description, 50));
$smarty->assign('input_subject',$this->CreateInputText($id, 'subject', $subject, 50));
//$smarty->assign('input_to_address',$this->CreateInputText($id, 'to_address', $to_address, 50));
//$smarty->assign('input_from_address',$this->CreateInputText($id, 'from_address', $from_address, 50));

$smarty->assign('input_message_html', $this->CreateTextArea(false, $id, $message_html, 'message_html','','','','',80,15,'','html'));
$smarty->assign('input_message_plain', $this->CreateTextArea(false, $id, $message_plain, 'message_plain','','','','',80,15,'','plain'));
$smarty->assign('input_code', $this->CreateTextArea(false, $id, $code, 'code','','','','',80,15,'','php'));

$smarty->assign('input_events', $this->CreateInputSelectList($id,'events[]',$eventsarray,$seleventsarray,10));
$smarty->assign('info_icon', cmsms()->get_variable('admintheme')->DisplayImage('icons/system/info.gif',$this->Lang('text_advanced_information')));

echo $this->ProcessTemplate('notification_addedit.tpl');

?>