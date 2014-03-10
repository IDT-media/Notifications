<?php
$lang['modulename'] = 'Notifications ';
$lang['module_description'] = 'Notifications Module is een flexibel Mailing systeem voor de CMSMS backend.';
$lang['postuninstall'] = 'Notifications gede&iuml;nstalleerd';
$lang['postinstall'] = 'Notifications ge&iuml;nstalleerd';
$lang['preuninstall'] = 'Weet u zeker dat u de Notifications module wilt de&iuml;nstalleren?';
$lang['are_you_sure'] = 'Dit item verwijderen?';
$lang['title_notifications'] = 'Berichten';
$lang['title_options'] = 'Opties';
$lang['text_additem'] = 'Item toevoegen';
$lang['text_advanced_information'] = 'Toggle Uitgebreide Informatie';
$lang['title_advanced_information'] = 'Beschikbare variabelen';
$lang['title_notification_object'] = 'Berichten object';
$lang['text_notification_object'] = '<ul>
    <li>$notification->id</li>
    <li>$notification->name</li>
    <li>$notification->description</li>
    <li>$notification->subject</li>
    <li>$notification->from_address</li>
    <li>$notification->to_address</li>
    <li>$notification->message_html</li>
    <li>$notification->message_plain</li>
    <li>$notification->create_date</li>
    <li>$notification->modified_date</li>
</ul>';
$lang['title_event_parameters'] = 'Gebeurtenis parameters';
$lang['text_event_parameters'] = '<ul>
    <li>$eventparams</li>
    <li>$originator</li>
    <li>$eventname</li>
</ul>';
$lang['text_notice_description'] = '<strong>Opmerking:</strong> {$notification} en {$eventparams} zijn toepasbaar in dit veld';
$lang['submit'] = 'Opslaan';
$lang['cancel'] = 'Annuleren';
$lang['permission'] = 'Permissies';
$lang['description'] = 'Omschrijving';
$lang['notification'] = 'Bericht';
$lang['name'] = 'Naam';
$lang['subject'] = 'Onderwerp';
$lang['status'] = 'Status ';
$lang['delete'] = 'Verwijderen';
$lang['edit'] = 'Wijzigen';
$lang['back'] = 'Terug';
$lang['from_address'] = 'Van adres';
$lang['to_address'] = 'Naar adres';
$lang['message_html'] = 'Bericht in HTML formaat';
$lang['message_plain'] = 'Bericht in normale text';
$lang['code'] = 'Code ';
$lang['events'] = 'Gebeurtenis';
$lang['basic'] = 'Standaard';
$lang['advanced'] = 'Uitgebreid';
$lang['itemdeleted'] = 'Bericht verwijderd';
$lang['itemsaved'] = 'Bericht is opgeslagen';
$lang['error_fieldempty'] = 'Veld %s is leeg';
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
$feu = cmsms()->GetModuleInstance(&#039;FrontEndUsers&#039;);
// get smarty
&amp;dollar;smarty = cmsms()-&amp;gt;GetSmarty();

// send a message to email address (assuming email is used as username)    
$notification->to_address =  $feu->GetUserName($feu->LoggedInId());

// get user properties
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
$lang['utma'] = '156861353.1470373327.1341242866.1341242866.1341242866.1';
$lang['utmz'] = '156861353.1341242866.1.1.utmccn=(direct)|utmcsr=(direct)|utmcmd=(none)';
$lang['utmb'] = '156861353';
$lang['utmc'] = '156861353';
?>