<?php
$lang['modulename'] = 'Notificaciones';
$lang['module_description'] = 'El m&oacute;dulo &#039;Notificaciones&#039; es un sistema flexible de notificaciones por correo electr&oacute;nico para el area administrativa de CMSMS.';
$lang['postuninstall'] = 'M&oacute;dulo Notificaciones has sido desinstalado';
$lang['postinstall'] = 'M&oacute;dulo Notificaciones has sido instalado';
$lang['preuninstall'] = '&iquest;De verdad desea desinstalar el m&oacute;dulo Notificaciones?';
$lang['are_you_sure'] = '&iquest;Borrar este elemento?';
$lang['changessaved'] = 'Sus cambios han sido guardados';
$lang['text_additem'] = 'Guardar notificaci&oacute;n';
$lang['module_options'] = 'Opciones del m&oacute;dulo';
$lang['sending_options'] = 'Opciones de env&iacute;o';
$lang['text_advanced_information'] = 'Alternar despliegue de informaci&oacute;n avanzada';
$lang['title_advanced_information'] = 'Variables disponibles';
$lang['title_notification_object'] = 'Objeto de notificaci&oacute;n';
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
$lang['title_event_parameters'] = 'Variables de eventos';
$lang['text_event_parameters'] = '<ul>
    <li>&amp;dollar;params: Arreglo</li>
    <li>&amp;dollar;originator: String </li>
    <li>&amp;dollar;eventname: String </li>
</ul>';
$lang['text_notice_description'] = '<strong>NOTA:</strong> {&amp;dollar;notification} and {&amp;dollar;params} son usables en este campo';
$lang['prompt_adminsection'] = 'Administraci&oacute;n del m&oacute;dulo';
$lang['help_param_notification'] = 'Definir el ID de la notificaci&oacute;n que desea desencadenar';
$lang['help_param_var_'] = 'Definir parametros anonimos que desea enviar con esta notificaci&oacute;n. Puede usarse en plantillas de notificaci&oacute;n por medio de la variable &amp;dollar;params';
$lang['mode'] = 'Modo';
$lang['submit'] = 'Enviar';
$lang['cancel'] = 'Cancelar';
$lang['permission'] = 'Permiso';
$lang['description'] = 'Descripci&oacute;n';
$lang['notification'] = 'Notificaci&oacute;n';
$lang['name'] = 'Nombre';
$lang['subject'] = 'Asunto';
$lang['status'] = 'Estado';
$lang['delete'] = 'Borrar';
$lang['edit'] = 'Editar';
$lang['back'] = 'Regresar';
$lang['from_address'] = 'Direcci&oacute;n Fuente';
$lang['to_address'] = 'Direcci&oacute;n(es) Destino';
$lang['message_html'] = 'Mensaje en formato HTML';
$lang['message_plain'] = 'Mensaje en texto simple';
$lang['code'] = 'C&oacute;digo';
$lang['events'] = 'Eventos';
$lang['basic'] = 'B&aacute;sivo';
$lang['advanced'] = 'Avanzado';
$lang['notifications'] = 'Notificaciones';
$lang['options'] = 'Opciones';
$lang['itemdeleted'] = 'Notificaci&oacute;n borrada';
$lang['itemsaved'] = 'Notificaci&oacute;n guardada';
$lang['error_fieldempty'] = 'El campo %s est&aacute; vac&iacute;o';
$lang['error_sendfailed'] = 'El env&iacute;o de la notificaci&oacute;n fall&oacute;: %s';
$lang['error_parse_error'] = 'Hay un error de parse en su c&oacute;digo PHP';
$lang['help_general_title'] = 'General';
$lang['help_usage_title'] = 'Uso';
$lang['help_general'] = '<h3>&iquest;Que hace este M&oacute;dulo?</h3>
<p>Este m&oacute;dulo es una manera flexible de enviar notificaciones por correo electronico del &aacute;rea administrativa de CMSMS.<br/>
Envia notificaciones por correo dependiendo de los eventos que suceden, estos eventos est&aacute;n disponibles en el Administrador de Eventos. Las plantillas de correo son completamente personalizables.
 <br />
Entre las opciones Avanzadas es posible personalizar el objeto de notificaci&oacute;n con c&oacute;digo PHP, similar al uso de UDT&#039;s.</p>';
$lang['help_usage'] = '<h3>&iquest;Como se usa?</h3>
<p>Es un process simple. Luego de instalado, se encuentra en Extensiones > Notificaciones</p>
<P>Para crear una nueva notificaci&oacute;n, agregue un Evento del Administrador de Eventos (m&oacute;dulo), por medio del cual el correo ser&aacute; enviado.</p>

<p>En &quot;Asunto&quot;, &quot;Mensaje en formato HTML&quot; y &quot;Mensaje en text simple&quot; se puede editar el contenido del mensaje a  <code>{&amp;dollar;notification}</code> y <code>{&amp;dollar;params}</code> son variables disponibles.</p>
<p>En la pesta&ntilde;a &quot;Avanzada&quot; se puede optimizar el objeto de notificaci&oacute;n con c&oacute;digo PHP personalizado.</p>
<br /><p><strong>Ejemplo:</strong></p>
<p>Si el M&oacute;dulo FrontEndUsers est&aacute; instalado y se desea enviar u mensaje personalizado cuando el usuario inicia la sesi&oacute;n, el c&oacute;digo siguiente asume que las propiedades first_name y last_name han sido configuradas en el m&oacute;dulo FrontEndUsers</p>
<pre><code>
// get FEU module
&amp;dollar;feu = cmsms()-&amp;gt;GetModuleInstance(&#039;FrontEndUsers&#039;);

// llamar a smarty
&amp;dollar;smarty = cmsms()-&amp;gt;GetSmarty();

// enviar mensaje a la direcci&oacute;n de correo  (se asume que su email es el nombre de usuario)    
&amp;dollar;notification-&amp;gt;to_address =  &amp;dollar;feu-&amp;gt;GetUserName(&amp;dollar;feu->LoggedInId());

// obtener propiedades del usuario
foreach (&amp;dollar;feu-&amp;gt;GetUserProperties(&amp;dollar;feu-&amp;gt;LoggedInId()) as &amp;dollar;prop) {
    &amp;dollar;user_props[&amp;dollar;prop[&#039;title&#039;]] = &amp;dollar;prop[&#039;data&#039;];
}

// pasar las propiedades a  smarty
&amp;dollar;smarty-&amp;gt;assign(&#039;first_name&#039;, &amp;dollar;user_props[&#039;first_name&#039;]);
&amp;dollar;smarty-&amp;gt;assign(&#039;last_name&#039;, &amp;dollar;user_props[&#039;last_name&#039;]);

</code></pre>

<br /><br /><p>Luego de esto, se tendr&aacute;n las variables <code>{&amp;dollar;first_name}</code> y <code>{&amp;dollar;last_name}</code> disponibles en el mensaje de Notificaci&oacute;n y la direcci&oacute;n Destino ya ser&iacute;a especificada<br /></p>
<br /><p><strong>Ejemplo:</strong></p>
<pre><code>
&amp;lt;h1&amp;gt;Bienvenido{if !empty(&amp;dollar;first_name)} {&amp;dollar;first_name}{/if}{if !empty(&amp;dollar;last_name)} {&amp;dollar;last_name}{/if}&amp;lt;/h1&amp;gt;,

&amp;lt;p&amp;gt;Gracias por acceder al sistema!&amp;lt;/p&amp;gt;.

</code></pre>

<h4>Ver el siguiente video para una demostraci&oacute;n visual.</h4>';
$lang['utma'] = '156861353.920242698.1386014977.1386014977.1386014977.1';
$lang['utmb'] = '156861353';
$lang['utmc'] = '156861353';
$lang['utmz'] = '156861353.1386014977.1.1.utmccn=(direct)|utmcsr=(direct)|utmcmd=(none)';
?>