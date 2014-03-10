/*-------------------------------------------------------------------------
* Module: Notifications
* Version: 1.1
*-------------------------------------------------------------------------
*
* Authors:
*
* Tapio Löytty, <tapsa@orange-media.fi>
* Web: www.orange-media.fi
*
* Goran Ilic, <uniqu3e@gmail.com>
* Web: www.ich-mach-das.at
*
*-------------------------------------------------------------------------
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
* Or read it online: http://www.gnu.org/licenses/licenses.html*GPL
*
*-------------------------------------------------------------------------*/

jQuery(document).ready(function($) {

	// toggle advanced info
	$('#notifications-info').hide();
	$('#notifications-toggle').click(function() {
		$('#notifications-info').toggle();
	});
	
	// toggle message textarea
	$('.accordion .pageinput').hide();
	$('.accordion .n_current').next('.pageinput').slideToggle('fast');
	$('.accordion .pagetext').click(function() {
		var trig = $(this);
		if (trig.hasClass('n_current')) {
			trig.next('.pageinput').slideToggle('fast');
			trig.removeClass('n_current','fast');
		} else {
			$('.n_current').next('.pageinput').slideToggle('fast');
			$('.n_current').removeClass('n_current','fast');
			trig.next('.pageinput').slideToggle('fast');
			trig.addClass('n_current');
		}
		return false;
	});
	
	// hide message after 9s
	$('.pagemcontainer').each(function() {
		var message = jQuery(this);
		window.setTimeout(function() {
			message.hide();
		}, 9000);
	});
	
	// Apply jQuery UI to elements
	$("input[type='text']").addClass('ui-widget ui-widget-content ui-corner-all');
	$(".ntfs-radio").buttonset();
});
