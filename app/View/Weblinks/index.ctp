<div class="weblinks index">
	<h2><?php echo __('Weblinks'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('weblink_category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('link'); ?></th>
			<th><?php echo $this->Paginator->sort('hits'); ?></th>
			<th><?php echo $this->Paginator->sort('published'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($weblinks as $weblink): ?>
	<tr>
		<td><?php echo h($weblink['Weblink']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($weblink['WeblinkCategory']['name'], array('controller' => 'weblink_categories', 'action' => 'view', $weblink['WeblinkCategory']['id'])); ?>
		</td>
		<td><?php echo h($weblink['Weblink']['title']); ?>&nbsp;</td>
		<td><?php echo h($weblink['Weblink']['description']); ?>&nbsp;</td>
		<td><?php echo h($weblink['Weblink']['link']); ?>&nbsp;</td>
		<td><?php echo h($weblink['Weblink']['hits']); ?>&nbsp;</td>
		<td><?php echo h($weblink['Weblink']['published']); ?>&nbsp;</td>
		<td><?php echo h($weblink['Weblink']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $weblink['Weblink']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $weblink['Weblink']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $weblink['Weblink']['id']), null, __('Are you sure you want to delete # %s?', $weblink['Weblink']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Weblink'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Weblink Categories'), array('controller' => 'weblink_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Weblink Category'), array('controller' => 'weblink_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
