<?php
$lang['modulename'] = 'Notifications (Benachrichtigungen)';
$lang['module_description'] = 'Notifications Modul ist ein flexibles Mailing System in CMSMS Administration.';
$lang['postuninstall'] = 'Notifications deinstalliert';
$lang['postinstall'] = 'Notifications installiert';
$lang['preuninstall'] = 'Wollen Sie wirklich, um Notifications Modul deinstallieren';
$lang['are_you_sure'] = 'Diesen Eintrag l&ouml;schen?';
$lang['title_notifications'] = 'Benachrichtigungen';
$lang['title_options'] = 'Optionen';
$lang['text_additem'] = 'Eintrag hinzuf&uuml;gen';
$lang['text_advanced_information'] = 'Erweiterte Informationen ansehen';
$lang['title_advanced_information'] = 'Verf&uuml;gbare Variablen';
$lang['title_notification_object'] = 'Notification Objekt';
$lang['text_notification_object'] = '<ul>
    <li>&amp;dollar;notification-&amp;gt;id</li>
    <li>&amp;dollar;notification-&amp;gt;name</li>
    <li>&amp;dollar;notification-&amp;gt;description</li>
    <li>&amp;dollar;notification-&amp;gt;subject</li>
    <li>&amp;dollar;notification-&amp;gt;from_address</li>
    <li>&amp;dollar;notification-&amp;gt;to_address</li>
    <li>&amp;dollar;notification-&amp;gt;message_html</li>
    <li>&amp;dollar;notification-&amp;gt;message_plain</li>
    <li>&amp;dollar;notification-&amp;gt;create_date</li>
    <li>&amp;dollar;notification-&amp;gt;modified_date</li>
</ul>';
$lang['title_event_parameters'] = 'Ereignis Parameter';
$lang['text_event_parameters'] = '<ul>
    <li>$eventparams</li>
    <li>$originator</li>
    <li>$eventname</li>
</ul>';
$lang['text_notice_description'] = '<strong>Bemerkung:</strong> {$notification} und {$eventparams} sind in diesen Feld verf&uuml;gbar';
$lang['submit'] = 'Absenden';
$lang['cancel'] = 'Abbrechen';
$lang['permission'] = 'Berechtigung';
$lang['description'] = 'Beschreibung';
$lang['notification'] = 'Nachricht';
$lang['name'] = 'Name';
$lang['subject'] = 'Betreff';
$lang['status'] = 'Status';
$lang['delete'] = 'L&ouml;schen';
$lang['edit'] = 'Bearbeiten';
$lang['back'] = 'Zur&uuml;ck';
$lang['from_address'] = 'Von Adresse';
$lang['to_address'] = 'An Adresse';
$lang['message_html'] = 'Nachricht in HTML format';
$lang['message_plain'] = 'Nachricht im Klartext';
$lang['code'] = 'Kode';
$lang['events'] = 'Ereignise';
$lang['basic'] = 'Basis';
$lang['advanced'] = 'Erweitert';
$lang['itemdeleted'] = 'Nachricht gel&ouml;scht';
$lang['itemsaved'] = 'Nachricht erfolgreich gespeichert.';
$lang['error_fieldempty'] = 'Feld %s ist leer';
$lang['help'] = '<h3>What does this module do?</h3>
<p>Notifications Module is a flexible Mailing system in CMSMS backend.</p>
<p>It sends out Email notifications on easy to setup events that are available in EventManager. Email Templates are fully customizable as well as Email Recipients or Sender. <br />
Within &quot;Advanced&quot; section it is possible to customize notification object with custom PHP code in the same familiar way as within UDT&#039;s.</p>
<h3>How do i use it?</h3>
<p>Using Notifications is fairly straight forward. After Module was installed you will find it unter &quot;Extensions &amp;raquo; Notifications&quot;.</p>
<p>To create a notification add new notification item and configure it to your needs.<br />
In the notification interface you will be able to select a Event available from Event Manager module on which email should be sent.<br />
In &quot;Subject&quot;, &quot;Message in HTML Format&quot; and &quot;Message in PLAIN Text&quot; you can compose your email Subject and Content where  <code>{$notification}</code> and <code>{$eventparams}</code> variables are available.</p>
<p>Within &quot;Advanced&quot; tab you are also able to optimize notification object with some custom PHP code</p>
<p><strong>Example:</strong></p>
<p>If you have FrontEndUsers Module installed and would like to send personalized message to a user after log in.<br />
Code below would assume that you have first_name and last_name user properties set up in FrontEndUsers module.</p>
<pre><code>
// get FEU module
&amp;dollar;feu = cmsms()-&amp;gt;GetModuleInstance(&#039;FrontEndUsers&#039;);
// get smarty
&amp;dollar;smarty = cmsms()-&amp;gt;GetSmarty();

// send a message to email address (assuming email is used as username)    
&amp;dollar;notification-&amp;gt;to_address =  &amp;dollar;feu-&amp;gt;GetUserName($feu->LoggedInId());

// get user proerties
foreach (&amp;dollar;feu-&amp;gt;GetUserProperties(&amp;dollar;feu-&amp;gt;LoggedInId()) as &amp;dollar;prop) {
    &amp;dollar;user_props[&amp;dollar;prop[&#039;title&#039;]] = &amp;dollar;prop[&#039;data&#039;];
}

// pass properties to smarty
&amp;dollar;smarty-&amp;gt;assign(&#039;first_name&#039;, &amp;dollar;user_props[&#039;first_name&#039;]);
&amp;dollar;smarty-&amp;gt;assign(&#039;last_name&#039;, &amp;dollar;user_props[&#039;last_name&#039;]);
</code></pre>
<br /><p>After this you would have <code>{$first_name}</code> and <code>{$last_name}</code> variables available in the Notification message fields and &quot;To address&quot; would already be specified.<br />
Now you could send for example daily offers or some greeting to a User after login</p>
<p><strong>Example:</strong></p>
<pre><code>
&amp;lt;h1&amp;gt;Welcome{if !empty(&amp;dollar;first_name)} {&amp;dollar;first_name}{/if}{if !empty(&amp;dollar;last_name)} {&amp;dollar;last_name}{/if}&amp;lt;/h1&amp;gt;,

&amp;lt;p&amp;gt;how is your day today&amp;lt;/p&amp;gt;.
&amp;lt;p&amp;gt;We have some great new offers for you today.... and so on...&amp;lt;/p&amp;gt;
</code></pre>';
$lang['utma'] = '156861353.592724346.1347938050.1348207512.1348214395.6';
$lang['utmz'] = '156861353.1348214395.6.5.utmccn=(referral)|utmcsr=dev.cmsmadesimple.org|utmcct=/|utmcmd=referral';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353';
?>