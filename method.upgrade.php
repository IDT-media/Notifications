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

$taboptarray = array('mysql' => 'TYPE=MyISAM');
$dict = NewDataDictionary($db);

if( version_compare($oldversion, '1.1') < 0 ) {
	
	// Attributes table
	$flds = "
		notification_id I KEY,
		name C(255) KEY,
		value X
	";
	$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_notifications_attributes", $flds, $taboptarray);
	$dict->ExecuteSQLArray($sqlarray);	
	
	// Adding new prefs
	$this->SetPreference('adminsection', 'extensions');
	
	// Drop old permissions
	$this->RemovePermission('Use Notifications');
	$this->RemovePermission('Advanced usage of Notifications');
	
	// Adding new permissions
	$this->CreatePermission($this->GetName() . '_manage_notifications', $this->GetName() . ': Manage Notifications');
	$this->CreatePermission($this->GetName() . '_advanced_usage', $this->GetName() . ': Advanced usage');
	$this->CreatePermission($this->GetName() . '_modify_options', $this->GetName() . ': Modify Options');
	
	// Register module plugin
	$this->RegisterModulePlugin(true);

} // end of 1.0 -> 1.1 upgrade

if( version_compare($oldversion, '1.2') < 0 ) {
	
	// Events
	$this->CreateEvent('PostSendNotification');

} // end of 1.1 -> 1.2 upgrade