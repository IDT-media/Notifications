{if count($items)}
<table cellspacing="0" cellpadding="0" class="pagetable">
	<thead>
	<tr>
		<th width="30">ID</th>
		<th>{$Notifications->Lang('notification')}</th>
		<th>{$Notifications->Lang('description')}</th>
		<th class="pageicon">&nbsp;</th>
		<th class="pageicon">&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	{foreach from=$items item=entry}
		{cycle values="row1,row2" assign='rowclass'}
		<tr class="{$rowclass}" onmouseover="this.className='{$rowclass}hover';" onmouseout="this.className='{$rowclass}';">
		<td>{$entry->id}</td>
		<td>{$entry->name}</td>
		<td>{$entry->description}</td>
		<td>{$entry->editlink}</td>
		<td>{$entry->deletelink}</td>
	</tr>
	{/foreach}
	</tbody>	
</table>
{/if}

<div class="pageoptions">{$add_item}</div>