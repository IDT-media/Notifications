{* Inline javascript
**********************************************************}

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#ntfs_from_address').tagit({
		fieldName: "{$actionid}from_address",
		tagLimit: 1
	});	
	
	$('#ntfs_to_address').tagit({
		fieldName: "{$actionid}to_address[]"
	});
});
</script>

{* HTML begins
**********************************************************}

{$startform}

{$Notifications->StartTabHeaders()}

	{$Notifications->SetTabHeader('basic', $Notifications->Lang('basic'))}

	{if $Notifications->CheckPermission('Notifications_advanced_usage')}
		{$Notifications->SetTabHeader('advanced', $Notifications->Lang('advanced'))}
	{/if}

	{$Notifications->SetTabHeader('options', $Notifications->Lang('options'))}

{$Notifications->EndTabHeaders()}
{$Notifications->StartTabContent()}

	{$Notifications->StartTab('basic')}

		<div class="pageoverflow">
			<p class="pagetext">{$Notifications->Lang('name')}:</p>
			<p class="pageinput">{$input_name}</p>
		</div>	

		<div class="pageoverflow">
			<p class="pagetext">{$Notifications->Lang('description')}:</p>
			<p class="pageinput">{$input_description}</p>
		</div>	

		<div class="pageoverflow">
			<p class="pagetext">{$Notifications->Lang('events')}:</p>
			<p class="pageinput">{$input_events}</p>
		</div>		

		<div class="pageoverflow">
			<p class="pagetext">{$Notifications->Lang('subject')}:</p>
			<div class="pageinput"><em class="info">{$Notifications->Lang('text_notice_description')}</em><br />{$input_subject}
			</div>
		</div>	

		<div class="pageoverflow">
			<p class="pagetext">{$Notifications->Lang('from_address')}:</p>
			<div class="pageinput">
				<ul id="ntfs_from_address">					
					<li>{$notification->from_address}</li>
				</ul>
			</div>
		</div>		

		<div class="pageoverflow">
			<p class="pagetext">{$Notifications->Lang('to_address')}:</p>
			<div class="pageinput">
				<ul id="ntfs_to_address">
					{foreach from=$notification->to_address item=address}
						<li>{$address}</li>
					{/foreach}
				</ul>
			</div>
		</div>		
		
		<div class="accordion">
		<div class="pageoverflow">
			<p class="pagetext n_current">{$Notifications->Lang('message_html')}:</p>
			<div class="pageinput"><em class="info">{$Notifications->Lang('text_notice_description')}</em><br />{$input_message_html}
			</div>
		</div>
		
		<div class="pageoverflow">
			<p class="pagetext">{$Notifications->Lang('message_plain')}:</p>
			<div class="pageinput"><em class="info">{$Notifications->Lang('text_notice_description')}</em><br />{$input_message_plain}
			</div>
		</div>
		</div>	
	
	{$Notifications->EndTab()}

	{if $Notifications->CheckPermission('Notifications_advanced_usage')}
	
	{$Notifications->StartTab('advanced')}	
	
		<div class="pageoverflow">
			<p class="pagetext">{$Notifications->Lang('code')}:</p>
			<div class="pageinput">{$input_code}</div>
		</div>		
	
		<div class="pageoverflow">
			<h3 class="pagetext" id='notifications-toggle'>{$info_icon} {$Notifications->Lang('title_advanced_information')}</h3>
			<div class="pageinput" id='notifications-info'>
				<fieldset style="width: 600px; padding: 20px">
				
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
				
					<tr><td width="50%" valign="top">
				
					<h5 style="margin: 0 10px 10px 10px"><em>{$Notifications->Lang('title_notification_object')}</em></h5>
				
					{$Notifications->Lang('text_notification_object')}

					</td><td valign="top">
					<h5 style="margin: 0 10px 10px 10px"><em>{$Notifications->Lang('title_event_parameters')}</em></h5>
				
					{$Notifications->Lang('text_event_parameters')}
					
					</td></tr>
					</table>
				</fieldset>
			</div>
		</div>
	
	{$Notifications->EndTab()}
	
	{/if}

	{$Notifications->StartTab('options')}
	
		<fieldset>
		<legend>{$Notifications->Lang('sending_options')}</legend>  
			<div class="pageoverflow">
				<p class="pagetext">{$Notifications->Lang('mode')}:</p>
				<div class="pageinput">
					<div class="ntfs-radio">
						<input type="radio" name="{$actionid}attributes[mode]" id="mode_1" value="html"{if $notification->GetAttribute('mode', 'html') == 'html'} checked="checked"{/if} />
						<label for="mode_1">HTML</label>
						
						<input type="radio" name="{$actionid}attributes[mode]" id="mode_2" value="plain"{if $notification->GetAttribute('mode') == 'plain'} checked="checked"{/if} />
						<label for="mode_2">PLAIN</label>			
					</div>					
				</div>
			</div>
		</fieldset>		
	
	{$Notifications->EndTab()}	
	
{$Notifications->EndTabContent()}

	<div class="pageoverflow">
		<p class="pagetext"></p>
		<p class="pageinput">{$submit}{$cancel}{$apply}</p>
	</div>
	
{$endform}