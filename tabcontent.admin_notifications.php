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
# Process list
#---------------------

$items = $this->GetItems();

foreach($items as $item) {

	$item->name = $this->CreateLink($id, 'admin_notification_addedit', $returnid, $item->name, array('nid'=>$item->id));
	$item->editlink = $this->CreateLink($id, 'admin_notification_addedit', $returnid, cmsms()->get_variable('admintheme')->DisplayImage('icons/system/edit.gif', $this->Lang('edit'),'','','systemicon'), array('nid'=>$item->id));
	$item->deletelink = $this->CreateLink($id, 'admin_notification_delete', $returnid, cmsms()->get_variable('admintheme')->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('nid'=>$item->id), $this->Lang('are_you_sure'));	
}

#---------------------
# Smarty processing
#---------------------

$smarty->assign('items', $items);

$smarty->assign('add_item', $this->CreateLink($id, 'admin_notification_addedit', $returnid, cmsms()->get_variable('admintheme')->DisplayImage('icons/system/newobject.gif',$this->Lang('text_additem'),'','','systemicon'),array(), '', false) . 
								$this->CreateLink($id, 'admin_notification_addedit', $returnid,$this->Lang('text_additem'),array(), '', false));
													
echo $this->ProcessTemplate('notifications_tab.tpl');

?>