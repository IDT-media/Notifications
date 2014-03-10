<?php
$lang['modulename'] = 'Notifications';
$lang['module_description'] = 'Le module Notifications est un syst&egrave;me flexible d&#039;envoi d&#039;email dans l&#039;admin de CMSMS.';
$lang['postuninstall'] = 'Le module Notifications a &eacute;t&eacute; d&eacute;sinstall&eacute;';
$lang['postinstall'] = 'Le module Notifications a &eacute;t&eacute; install&eacute;';
$lang['preuninstall'] = '&Ecirc;tes vous s&ucirc;re(e) de vouloir d&eacute;sinstaller Notifications ?';
$lang['are_you_sure'] = 'Supprimer cet item ?';
$lang['changessaved'] = 'Vos modifications ont &eacute;t&eacute; enregistr&eacute;es.';
$lang['text_additem'] = 'Ajouter un item';
$lang['module_options'] = 'Options du module';
$lang['sending_options'] = 'Options d&#039;envoi';
$lang['text_advanced_information'] = 'Basculer vers information avanc&eacute;e';
$lang['title_advanced_information'] = 'Variables disponibles';
$lang['title_notification_object'] = 'Objet de la notification';
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
$lang['title_event_parameters'] = 'Param&egrave;tres &eacute;v&eacute;nements';
$lang['text_event_parameters'] = '<ul>
    <li>&amp;dollar;params: Array</li>
    <li>&amp;dollar;originator: String</li>
    <li>&amp;dollar;eventname: String</li>
</ul>';
$lang['text_notice_description'] = '<strong>NOTA :</strong> {$notification} et {$eventparams} utilisable dans ce champ';
$lang['prompt_adminsection'] = 'Section d&#039;administration du module';
$lang['help_param_notification'] = 'D&eacute;finir l&#039;ID de la notification que vous voulez d&eacute;clencher.';
$lang['help_param_var_'] = 'D&eacute;finir tout param&egrave;tre anonyme que vous souhaitez envoyer dans cette notification. Peut &ecirc;tre utilis&eacute; dans les gabarits de notifications via la variable $params.';
$lang['mode'] = 'Mode';
$lang['submit'] = 'Envoyer';
$lang['cancel'] = 'Annuler';
$lang['permission'] = 'Permission';
$lang['description'] = 'Description';
$lang['notification'] = 'Notification';
$lang['name'] = 'Nom';
$lang['subject'] = 'Sujet';
$lang['status'] = 'Statut';
$lang['delete'] = 'Supprimer';
$lang['edit'] = '&Eacute;diter';
$lang['back'] = 'Retour';
$lang['from_address'] = 'From adresse';
$lang['to_address'] = 'To adresse';
$lang['message_html'] = 'Message au format HTML';
$lang['message_plain'] = 'Message en mode texte';
$lang['code'] = 'Code';
$lang['events'] = '&Eacute;v&eacute;nements';
$lang['basic'] = 'Basique';
$lang['advanced'] = 'Avanc&eacute;';
$lang['notifications'] = 'Notifications';
$lang['options'] = 'Options';
$lang['itemdeleted'] = 'La notification a &eacute;t&eacute; supprim&eacute;e';
$lang['itemsaved'] = 'La notification a &eacute;t&eacute; sauvegard&eacute;e.';
$lang['error_fieldempty'] = 'Champ %s vide';
$lang['error_sendfailed'] = 'L&#039;envoi de notification a &eacute;chou&eacute; : %s';
$lang['error_parse_error'] = 'Il y a une erreur d&#039;analyse syntaxique (parsing) de votre code PHP';
$lang['help_general_title'] = 'G&eacute;n&eacute;ral';
$lang['help_usage_title'] = 'Usage';
$lang['help_general'] = '<h3>Que fait ce module ?</h3>
<p>Notifications Module is a flexible Mailing system in CMSMS backend.</p>
<p>It sends out Email notifications on easy to setup events that are available in Event Manager. Email Templates are fully customizable as well as Email Recipients or Sender. <br />
Within &quot;Advanced&quot; section it is possible to customize notification object with custom PHP code in the same familiar way as within UDT&#039;s.</p>';
$lang['help_usage'] = '<h3>Comment l&#039;utiliser ?</h3>
<p>Using Notifications is fairly straight forward. After Module was installed you will find it unter &quot;Extensions &amp;raquo; Notifications&quot;.</p>
<p>To create a notification add new notification item and configure it to your needs.<br />
In the notification interface you will be able to select a Event available from Event Manager module on which email should be sent.<br />
In &quot;Subject&quot;, &quot;Message in HTML Format&quot; and &quot;Message in PLAIN Text&quot; you can compose your email Subject and Content where  <code>{&amp;dollar;notification}</code> and <code>{&amp;dollar;params}</code> variables are available.</p>
<p>Within &quot;Advanced&quot; tab you are also able to optimize notification object with some custom PHP code</p>
<br /><p><strong>Example:</strong></p>
<p>If you have FrontEndUsers Module installed and would like to send personalized message to a user after log in.<br />
Code below would assume that you have first_name and last_name user properties set up in FrontEndUsers module.</p>
<pre><code>
// get FEU module
&amp;dollar;feu = cmsms()-&amp;gt;GetModuleInstance(&#039;FrontEndUsers&#039;);

// get smarty
&amp;dollar;smarty = cmsms()-&amp;gt;GetSmarty();

// send a message to email address (assuming email is used as username)    
&amp;dollar;notification-&amp;gt;to_address =  &amp;dollar;feu-&amp;gt;GetUserName(&amp;dollar;feu->LoggedInId());

// get user proerties
foreach (&amp;dollar;feu-&amp;gt;GetUserProperties(&amp;dollar;feu-&amp;gt;LoggedInId()) as &amp;dollar;prop) {
    &amp;dollar;user_props[&amp;dollar;prop[&#039;title&#039;]] = &amp;dollar;prop[&#039;data&#039;];
}

// pass properties to smarty
&amp;dollar;smarty-&amp;gt;assign(&#039;first_name&#039;, &amp;dollar;user_props[&#039;first_name&#039;]);
&amp;dollar;smarty-&amp;gt;assign(&#039;last_name&#039;, &amp;dollar;user_props[&#039;last_name&#039;]);

</code></pre>

<br /><br /><p>After this you would have <code>{&amp;dollar;first_name}</code> and <code>{&amp;dollar;last_name}</code> variables available in the Notification message fields and &quot;To address&quot; would already be specified.<br />
Now you could send for example daily offers or some greeting to a User after login</p>
<br /><p><strong>Example:</strong></p>
<pre><code>
&amp;lt;h1&amp;gt;Welcome{if !empty(&amp;dollar;first_name)} {&amp;dollar;first_name}{/if}{if !empty(&amp;dollar;last_name)} {&amp;dollar;last_name}{/if}&amp;lt;/h1&amp;gt;,';
$lang['qca'] = 'P0-483686814-1251229608352';
?>