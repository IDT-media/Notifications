<?php

# Basic
$lang['modulename'] = 'Notifications';
$lang['module_description'] = 'Notifications Module is a flexible Mailing system in CMSMS backend.';
$lang['postuninstall'] = 'Notifications uninstalled';
$lang['postinstall'] = 'Notifications installed';
$lang['preuninstall'] = 'Do you really wan\'t to uninstall Notifications?';
$lang['are_you_sure'] = 'Delete this item?';

# Text
$lang['changessaved'] = 'Your changes have been successfully saved.';
$lang['text_additem'] = 'Add notification';
$lang['module_options'] = 'Module Options';
$lang['sending_options'] = 'Sending Options';
$lang['text_advanced_information'] = 'Toggle Advanced Information';
$lang['title_advanced_information'] = 'Available variables';
$lang['title_notification_object'] = 'Notification object';
$lang['text_notification_object'] = '
<ul>
    <li>&dollar;notification-&gt;id</li>
    <li>&dollar;notification-&gt;name</li>
    <li>&dollar;notification-&gt;description</li>
    <li>&dollar;notification-&gt;subject</li>
    <li>&dollar;notification-&gt;from_address</li>
    <li>&dollar;notification-&gt;to_address</li>
    <li>&dollar;notification-&gt;message_html</li>
    <li>&dollar;notification-&gt;message_plain</li>
    <li>&dollar;notification-&gt;create_date</li>
    <li>&dollar;notification-&gt;modified_date</li>
</ul>';
$lang['title_event_parameters'] = 'Event variables';
$lang['text_event_parameters'] = '
<ul>
    <li>&dollar;params: Array</li>
    <li>&dollar;originator: String</li>
    <li>&dollar;eventname: String</li>
</ul>';
$lang['text_notice_description'] = '<strong>NOTICE:</strong> {&dollar;notification} and {&dollar;params} usable in this field';

# Options
$lang['prompt_adminsection'] = 'Module Admin Section';

# Params
$lang['help_param_notification'] = 'Define notification ID you want to trigger.';
$lang['help_param_var_'] = 'Define anonymous params you want to send to this notification. Can be used in notification templates via &dollar;params variable.';

# Single words
$lang['mode'] = 'Mode';
$lang['submit'] = 'Submit';
$lang['cancel'] = 'Cancel';
$lang['permission'] = 'Permission';
$lang['description'] = 'Description';
$lang['notification'] = 'Notification';
$lang['name'] = 'Name';
$lang['subject'] = 'Subject';
$lang['status'] = 'Status';
$lang['delete'] = 'Delete';
$lang['edit'] = 'Edit';
$lang['back'] = 'Back';
$lang['from_address'] = 'From address';
$lang['to_address'] = 'To address(es)';
$lang['message_html'] = 'Message in HTML format';
$lang['message_plain'] = 'Message in PLAIN text';
$lang['code'] = 'Code';
$lang['events'] = 'Events';
$lang['basic'] = 'Basic';
$lang['advanced'] = 'Advanced';
$lang['notifications'] = 'Notifications';
$lang['options'] = 'Options';

# Tab messages
$lang['itemdeleted'] = 'Notification deleted';
$lang['itemsaved'] = 'Notification was successfully saved.';

# Error messages
$lang['error_fieldempty'] = 'Field %s is empty';
$lang['error_sendfailed'] = 'Sending notification failed: %s';
$lang['error_parse_error'] = 'There is parse error with your PHP code';

# Event descriptions
$lang['eventdesc_PostSendNotification'] = 'Sent after notification has been sent.';

#Event help
$lang['eventhelp_PostSendNotification'] = <<<EOT
<p>{$lang['eventdesc_PostSendNotification']}</p>
<h4>Parameters</h4>
<ul>
<li>'mail_object' - Reference to affected mail object.</li>
</ul>
EOT;

# Help
$lang['help_general_title'] = 'General';
$lang['help_usage_title'] = 'Usage';

$lang['help_general'] = <<<EOT
<h3>What does this module do?</h3>
<p>Notifications Module is a flexible Mailing system in CMSMS backend.</p>
<p>It sends out Email notifications on easy to setup events that are available in Event Manager. Email Templates are fully customizable as well as Email Recipients or Sender. <br />
Within "Advanced" section it is possible to customize notification object with custom PHP code in the same familiar way as within UDT's.</p>
EOT;

$lang['help_usage'] = <<<EOT
<h3>How do i use it?</h3>
<p>Using Notifications is fairly straight forward. After Module was installed you will find it unter "Extensions &raquo; Notifications".</p>
<p>To create a notification add new notification item and configure it to your needs.<br />
In the notification interface you will be able to select a Event available from Event Manager module on which email should be sent.<br />
In "Subject", "Message in HTML Format" and "Message in PLAIN Text" you can compose your email Subject and Content where  <code>{&dollar;notification}</code> and <code>{&dollar;params}</code> variables are available.</p>
<p>Within "Advanced" tab you are also able to optimize notification object with some custom PHP code</p>
<br /><p><strong>Example:</strong></p>
<p>If you have FrontEndUsers Module installed and would like to send personalized message to a user after log in.<br />
Code below would assume that you have first_name and last_name user properties set up in FrontEndUsers module.</p>
<pre><code>
// get FEU module
&dollar;feu = cmsms()-&gt;GetModuleInstance('FrontEndUsers');

// get smarty
&dollar;smarty = cmsms()-&gt;GetSmarty();

// send a message to email address (assuming email is used as username)    
&dollar;notification-&gt;to_address =  &dollar;feu-&gt;GetUserName(&dollar;feu->LoggedInId());

// get user proerties
foreach (&dollar;feu-&gt;GetUserProperties(&dollar;feu-&gt;LoggedInId()) as &dollar;prop) {
    &dollar;user_props[&dollar;prop['title']] = &dollar;prop['data'];
}

// pass properties to smarty
&dollar;smarty-&gt;assign('first_name', &dollar;user_props['first_name']);
&dollar;smarty-&gt;assign('last_name', &dollar;user_props['last_name']);

</code></pre>

<br /><br /><p>After this you would have <code>{&dollar;first_name}</code> and <code>{&dollar;last_name}</code> variables available in the Notification message fields and "To address" would already be specified.<br />
Now you could send for example daily offers or some greeting to a User after login</p>
<br /><p><strong>Example:</strong></p>
<pre><code>
&lt;h1&gt;Welcome{if !empty(&dollar;first_name)} {&dollar;first_name}{/if}{if !empty(&dollar;last_name)} {&dollar;last_name}{/if}&lt;/h1&gt;,

&lt;p&gt;how is your day today&lt;/p&gt;.
&lt;p&gt;We have some great new offers for you today.... and so on...&lt;/p&gt;

</code></pre>

<h4>Watch this video for more visual demonstration</h4>
EOT;
?>
