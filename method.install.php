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
# Database tables
#---------------------

$db = cmsms()->GetDb();
//$config = cmsms()->GetConfig();

$dict = NewDataDictionary($db);
$taboptarray = array('mysql' => 'TYPE=MyISAM');

# Item table
$flds = "
	id I KEY AUTO,
	name C(255),
	description C(255),
	subject C(255),
	from_address C(255),
	to_address C(255),
	message_html X,
	message_plain X,
	code X,
	create_date DT,
	modified_date DT
";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_notifications_items", $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

# Event table
$flds = "
	notification_id I KEY,
	event_id I KEY
";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_notifications_events", $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

# Attributes table
$flds = "
	notification_id I KEY,
	name C(255) KEY,
	value X
";
$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_notifications_attributes", $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

#---------------------
# Events
#---------------------

$this->CreateEvent('PostSendNotification');

#---------------------
# Preferences
#---------------------

$this->SetPreference('adminsection', 'extensions');

#---------------------
# Permissions
#---------------------

$this->CreatePermission($this->GetName() . '_manage_notifications', $this->GetName() . ': Manage Notifications');
$this->CreatePermission($this->GetName() . '_advanced_usage', $this->GetName() . ': Advanced usage');
$this->CreatePermission($this->GetName() . '_modify_options', $this->GetName() . ': Modify Options');

#---------------------
# Smarty
#---------------------

$this->RegisterModulePlugin(true);
