<div class="contactDetails index">
	<h2><?php echo __('Contact Details'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('manager'); ?></th>
			<th><?php echo $this->Paginator->sort('telephone_1'); ?></th>
			<th><?php echo $this->Paginator->sort('telephone_2'); ?></th>
			<th><?php echo $this->Paginator->sort('fax'); ?></th>
			<th><?php echo $this->Paginator->sort('mobile'); ?></th>
			<th><?php echo $this->Paginator->sort('sms_center'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($contactDetails as $contactDetail): ?>
	<tr>
		<td><?php echo h($contactDetail['ContactDetail']['id']); ?>&nbsp;</td>
		<td><?php echo h($contactDetail['ContactDetail']['title']); ?>&nbsp;</td>
		<td><?php echo h($contactDetail['ContactDetail']['manager']); ?>&nbsp;</td>
		<td><?php echo h($contactDetail['ContactDetail']['telephone_1']); ?>&nbsp;</td>
		<td><?php echo h($contactDetail['ContactDetail']['telephone_2']); ?>&nbsp;</td>
		<td><?php echo h($contactDetail['ContactDetail']['fax']); ?>&nbsp;</td>
		<td><?php echo h($contactDetail['ContactDetail']['mobile']); ?>&nbsp;</td>
		<td><?php echo h($contactDetail['ContactDetail']['sms_center']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $contactDetail['ContactDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $contactDetail['ContactDetail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $contactDetail['ContactDetail']['id']), null, __('Are you sure you want to delete # %s?', $contactDetail['ContactDetail']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Contact Detail'), array('action' => 'add')); ?></li>
	</ul>
</div>
