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

class ntfsNotification
{
	#---------------------
	# Attributes
	#---------------------

	public $id;
	public $name;
	public $description;
	public $subject;
	public $from_address;
	public $to_address;
	public $message_html;
	public $message_plain;
	public $created;
	public $modified;
	
	private $_attributes;

	#---------------------
	# Magic methods
	#---------------------		
	
	public function __construct()
	{	
		$this->id = -1;
		$this->name = '';
		$this->description = '';
		$this->subject = '';
		$this->from_address = '';
		$this->to_address = array();
		$this->message_html = '';
		$this->message_plain = '';
		$this->created = '';
		$this->modified = '';	
		
		$this->_attributes = array();
	}
	
	#---------------------
	# Attribute methods
	#---------------------

	public function SetAttribute($key, $value)
	{
		$this->_attributes[$key] = $value;
	}
	
	public function GetAttribute($key, $default = '')
	{	
		return isset($this->_attributes[$key]) ? $this->_attributes[$key] : $default;
	}	
	
	public function GetAttributes()
	{
		return $this->_attributes;
	}	

} // end of class

?>