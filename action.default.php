<?php
#-------------------------------------------------------------------------
# Module: Notifications
# Version: 1.0, Tapio Löytty stikki@cmsmadesimple.org
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2007 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
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
# Init
#---------------------  
 
if(!isset($params['notification']))
	return;

#---------------------
# Process
#---------------------

$obj = new ntfsNotification;
if(ntfs_handler::Load($obj, $params['notification'], FALSE)) {

	$this->EvalCode($obj, $params);
	$this->SendNotification($obj, $params);
}

?>