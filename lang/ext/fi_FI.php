<?php
$lang['modulename'] = 'Notifications';
$lang['module_description'] = 'Notifications moduuli on joustava s&auml;hk&ouml;postin l&auml;hetys j&auml;rjestelm&auml; CMSMS hallintapuolelle.';
$lang['postuninstall'] = 'Notifications moduuli poistettu';
$lang['postinstall'] = 'Notifications moduuli asennettu';
$lang['preuninstall'] = 'Oletko varma ett&auml; haluat poistaa Notifications moduulin?';
$lang['are_you_sure'] = 'Oletko varma ett&auml; haluat poistaa t&auml;m&auml;n kohteen?';
$lang['title_notifications'] = 'Huomautukset';
$lang['title_options'] = 'Asetukset';
$lang['text_additem'] = 'Lis&auml;&auml; kohde';
$lang['text_advanced_information'] = 'Vaihda edistyneiden tietojen tilaa';
$lang['title_advanced_information'] = 'Saatavilla olevat muuttujat';
$lang['title_notification_object'] = 'Notification objekti';
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
$lang['title_event_parameters'] = 'Event parametrit';
$lang['text_event_parameters'] = '<ul>
    <li>$eventparams</li>
    <li>$originator</li>
    <li>$eventname</li>
</ul>';
$lang['text_notice_description'] = '<strong>HUOMAA:</strong> {$notification} ja {$eventparams} k&auml;ytett&auml;viss&auml; t&auml;ss&auml; kent&auml;ss&auml;';
$lang['submit'] = 'L&auml;het&auml;';
$lang['cancel'] = 'Peruuta';
$lang['permission'] = 'Oikeus';
$lang['description'] = 'Kuvaus';
$lang['notification'] = 'Huomautus';
$lang['name'] = 'Nimi';
$lang['subject'] = 'Aihe';
$lang['status'] = 'Tila';
$lang['delete'] = 'Poista';
$lang['edit'] = 'Muokkaa';
$lang['back'] = 'Takaisin';
$lang['from_address'] = '&quot;From&quot; osoite';
$lang['to_address'] = '&quot;To&quot; osoite';
$lang['message_html'] = 'Viesti HTML muodossa';
$lang['message_plain'] = 'Viesti PLAIN muodossa';
$lang['code'] = 'Koodi';
$lang['events'] = 'Tapahtumat';
$lang['basic'] = 'Yksinkertainen';
$lang['advanced'] = 'Edistynyt';
$lang['itemdeleted'] = 'Huomautus poistettu';
$lang['itemsaved'] = 'Huomautus tallennettu';
$lang['error_fieldempty'] = 'Kentt&auml; %s on tyhj&auml;';
$lang['help'] = '<h3>Mit&auml; t&auml;m&auml; moduuli tekee?</h3>
<p>Notifications moduuli on joustava s&auml;hk&ouml;postin l&auml;hetys j&auml;rjestelm&auml; CMSMS hallintapuolelle.</p>
<p>Notifications moduulilla voi l&auml;hett&auml;&auml; s&auml;hk&ouml;posti viestej&auml; sitomalla huomautuksia mihin tahansa EventManagerissa olevaan tapahtumaan. Kaikki pohjat ovat t&auml;ysin kustomoitavissa, kuten my&ouml;s vastaanottaja sek&auml; l&auml;hett&auml;j&auml; <br />
&quot;Edistynyt&quot; v&auml;lilehdell&auml; voit manipuloida notification objektia haluamallasi tavalla. Objektia muokataan PHP:lla samaan tyyliin kuin muokkaisit UDT:ta</p>
<h3>Miten moduulia k&auml;ytet&auml;&auml;n?</h3>
<p>Moduulin k&auml;ytt&ouml; on hyvin yksinkertaista. Asennuksen j&auml;lkeen l&ouml;yd&auml;t sen &quot;Laajennokset &amp;raquo; Notifications&quot;.</p>
<p>Luodaksesi uusi huomautus sinun ei tarvitse muuta kuin painaa &quot;Lis&auml;&auml; kohde&quot;, t&auml;m&auml;n j&auml;lkeen muokkaat viestin haluamanlaiseksesi.<br />Lis&auml;tess&auml;si huomautusta voit valita mihin j&auml;rjestelm&auml;ss&auml; olevaan tapahtumaan haluat huomautuksen liitett&auml;v&auml;n. Huomautus l&auml;hetet&auml;&auml;n aina kun tapahtuma suoritetaan.<br />
Riveill&auml;: &quot;Aihe&quot;, &quot;Viesti HTML muodossa&quot; and &quot;Viesti PLAIN muodossa&quot; on k&auml;yt&ouml;ss&auml;si smarty muuttujat: <code>{$notification}</code> and <code>{$eventparams}</code></p>
<p>V&auml;lilehdell&auml;: &quot;Edistynyt&quot; voit muokata notification objectia PHP:lla. Objektin manipulointi tapahtuu juuri ennen s&auml;hk&ouml;postin l&auml;hett&auml;mist&auml;.</p>
<p><strong>Esimerkki:</strong></p>
<p>Mik&auml;li sinulla on FrontEndUser moduuli asennettuna ja haluat l&auml;hett&auml;&auml; yksil&ouml;llisen viestin heti jonkun kirjauduttua j&auml;rjestelm&auml;&auml;n.<br />
Alla oleva koodi edellytt&auml;&auml; ett&auml; sinulla on first_name ja last_name ominaisuudet m&auml;&auml;riteltyn&auml; FrontEndUsers moduuliin.</p>
<pre><code>
// get FEU module
$feu = cmsms()->GetModuleInstance(&#039;FrontEndUsers&#039;);
// get smarty
$smarty = cmsms()->GetSmarty();

// send a message to email address (assuming email is used as username)    
$notification->to_address =  $feu->GetUserName($feu->LoggedInId());

// get user proerties
foreach ($feu->GetUserProperties($feu->LoggedInId()) as $prop) {
    $user_props[$prop[&#039;title&#039;]] = $prop[&#039;data&#039;];
}

// pass properties to smarty
$smarty->assign(&#039;first_name&#039;, $user_props[&#039;first_name&#039;]);
$smarty->assign(&#039;last_name&#039;, $user_props[&#039;last_name&#039;]);
</code></pre>
<br /><p>T&auml;m&auml;n j&auml;lkeen voit k&auml;ytt&auml;&auml; <code>{$first_name}</code> ja <code>{$last_name}</code> muuttujia kentiss&auml; miss&auml; smarty prosessoidaan ennen l&auml;hett&auml;mist&auml;.<br />
Nyt voit l&auml;hett&auml;&auml; vaikka p&auml;ivitt&auml;isi&auml; tarjouksia heti k&auml;ytt&auml;j&auml;n kirjauduttua j&auml;rjestelm&auml;&auml;n</p>
<p><strong>Esimerkki:</strong></p>
<pre><code>
<h1>Tervetuloa{if !empty($first_name)} {$first_name}{/if}{if !empty($last_name)} {$last_name}{/if}</h1>,

<p>kuinka sinun p&auml;iv&auml;si on l&auml;htenyt k&auml;yntiin</p>.
<p>Meill&auml; on sinulle hienoja tarjouksia, jne, jne, jne...</p>
</code></pre>
';
$lang['utma'] = '156861353.946686221.1341233804.1341233804.1341233804.1';
$lang['utmz'] = '156861353.1341233804.1.1.utmccn=(direct)|utmcsr=(direct)|utmcmd=(none)';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353';
?>