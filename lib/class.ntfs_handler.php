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

class ntfs_handler
{
	#---------------------
	# Magic methods
	#---------------------		
	
	private function __construct() {}
	
	#---------------------
	# Database methods
	#---------------------	
	
	static final public function Save(ntfsNotification &$obj)
	{
		$db = cmsms()->GetDb();
	
		$time = $db->DBTimeStamp(time());
			
		if ($obj->id > 0) {
		
			$query = "UPDATE ".cms_db_prefix()."module_notifications_items SET name = ?, description = ?, subject = ?, from_address = ?, to_address = ?, message_html = ?, message_plain = ?, code = ?, modified_date = ".$time." WHERE id = ?";
			
			$dbresult = $db->Execute($query, array(
				$obj->name, 
				$obj->description, 
				$obj->subject, 
				$obj->from_address, 
				implode(',', $obj->to_address), // a bit bad :(
				$obj->message_html, 
				$obj->message_plain, 
				$obj->code, 
				$obj->id
			));
			
		} else {

			$query = "INSERT INTO ".cms_db_prefix()."module_notifications_items (name, description, subject, from_address, to_address, message_html, message_plain, code, create_date, modified_date) VALUES (?,?,?,?,?,?,?,?,".$time.",".$time.")";
			
			$dbresult = $db->Execute($query, array(
				$obj->name, 
				$obj->description, 
				$obj->subject, 
				$obj->from_address, 
				implode(',', $obj->to_address), // a bit bad :(
				$obj->message_html, 
				$obj->message_plain, 
				$obj->code
			));
			
			$obj->id = $db->Insert_ID();
		}
		
		// Drop old events
		$query = "DELETE FROM ".cms_db_prefix()."module_notifications_events WHERE notification_id = ?";	
		$db->Execute($query, array($obj->id));
		
		// Update events
		$query = "INSERT INTO ".cms_db_prefix()."module_notifications_events (notification_id, event_id) VALUES (?,?)";
		foreach($obj->events as $eventid) {
		
			$dbresult = $db->Execute($query, array($obj->id, $eventid));
			if (!$dbresult) 
				die('FATAL SQL ERROR: ' . $db->ErrorMsg() . '<br/>QUERY: ' . $db->sql);			
		}
		
		// Drop all attributes
		$query = 'DELETE FROM ' . cms_db_prefix() . 'module_notifications_attributes WHERE notification_id = ?';
		$db->Execute($query, array($obj->id));		
		
		// Insert all attributes
		$query = 'INSERT INTO ' . cms_db_prefix() . 'module_notifications_attributes (notification_id, name, value) VALUES (?, ?, ?)';
		foreach($obj->GetAttributes() as $key => $value) {
		
            $dbresult = $db->Execute($query, array($obj->id, $key, $value));			
			if (!$dbresult) 
				die('FATAL SQL ERROR: ' . $db->ErrorMsg() . '<br/>QUERY: ' . $db->sql);
		}		
	}

	static final public function Delete(ntfsNotification &$obj)
	{
		$db = cmsms()->GetDb();

		if ($obj->id > 0) {

			// Delete from items
			$query = "DELETE FROM ".cms_db_prefix()."module_notifications_items WHERE id = ?";
			$db->Execute($query, array($obj->id));
			
			// Delete from events
			$query = "DELETE FROM ".cms_db_prefix()."module_notifications_events WHERE notification_id = ?";	
			$db->Execute($query, array($obj->id));
			
			// Delete from attributes
			$query = "DELETE FROM ".cms_db_prefix()."module_notifications_attributes WHERE notification_id = ?";	
			$db->Execute($query, array($obj->id));
				
			$obj->__construct(); // <- This is here only because this damn thing is passed by reference. Can't unset object.
							
			return true;
		}

		return FALSE;
	}
	
	static final public function Load(ntfsNotification &$obj, $id, $full = true)
	{
		$db = cmsms()->GetDb();

		$query = "SELECT * FROM ".cms_db_prefix()."module_notifications_items WHERE id = ?";
		$row = $db->GetRow($query, array($id));

		if ($row) {
		
			// Set static
			$obj->id = $row['id'];
			$obj->name = $row['name'];
			$obj->description = $row['description'];
			$obj->subject = $row['subject'];
			$obj->from_address = $row['from_address'];
			$obj->to_address = explode(',', $row['to_address']); // a bit bad :(
			$obj->message_html = $row['message_html'];
			$obj->message_plain = $row['message_plain'];
			$obj->created = $row['create_date'];
			$obj->modified = $row['modified_date'];
			
			// Set overloaded
			if($full) {
			
				$obj->events = self::LoadEvents($obj);
				$obj->code = $row['code'];
			}
			
			// Set attributes
			$query = 'SELECT name, value FROM ' . cms_db_prefix() . 'module_notifications_attributes WHERE notification_id = ?';
			$dbr = $db->Execute($query, array($obj->id));
			
			while($dbr && !$dbr->EOF) {
			
				$obj->SetAttribute($dbr->fields['name'], $dbr->fields['value']);
				$dbr->MoveNext();
			}		

			if($dbr) 
				$dbr->Close();				
						
			return true;
		}

		return FALSE;
	}	

	static final public function LoadEvents(ntfsNotification &$obj)
	{
		$db = cmsms()->GetDb();	
	
		$result = array();
	
		$query = "SELECT event_id FROM ".cms_db_prefix()."module_notifications_events WHERE notification_id = ?";
		$dbr = $db->Execute($query, array($obj->id));

		while($dbr && !$dbr->EOF) {
		
			$result[] = $dbr->fields['event_id'];
			$dbr->MoveNext();
		}
		
		if($dbr) 
			$dbr->Close();
		
		return $result;
	}
	
} // end of class

?>