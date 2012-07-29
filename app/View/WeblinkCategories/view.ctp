<div class="weblinkCategories view">
<h2><?php  echo __('Weblink Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($weblinkCategory['WeblinkCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Weblink Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($weblinkCategory['ParentWeblinkCategory']['name'], array('controller' => 'weblink_categories', 'action' => 'view', $weblinkCategory['ParentWeblinkCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($weblinkCategory['WeblinkCategory']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Weblink Category'), array('action' => 'edit', $weblinkCategory['WeblinkCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Weblink Category'), array('action' => 'delete', $weblinkCategory['WeblinkCategory']['id']), null, __('Are you sure you want to delete # %s?', $weblinkCategory['WeblinkCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Weblink Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Weblink Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Weblink Categories'), array('controller' => 'weblink_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Weblink Category'), array('controller' => 'weblink_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Weblinks'), array('controller' => 'weblinks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Weblink'), array('controller' => 'weblinks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Weblink Categories'); ?></h3>
	<?php if (!empty($weblinkCategory['ChildWeblinkCategory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($weblinkCategory['ChildWeblinkCategory'] as $childWeblinkCategory): ?>
		<tr>
			<td><?php echo $childWeblinkCategory['id']; ?></td>
			<td><?php echo $childWeblinkCategory['parent_id']; ?></td>
			<td><?php echo $childWeblinkCategory['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'weblink_categories', 'action' => 'view', $childWeblinkCategory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'weblink_categories', 'action' => 'edit', $childWeblinkCategory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'weblink_categories', 'action' => 'delete', $childWeblinkCategory['id']), null, __('Are you sure you want to delete # %s?', $childWeblinkCategory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Weblink Category'), array('controller' => 'weblink_categories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Weblinks'); ?></h3>
	<?php if (!empty($weblinkCategory['Weblink'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Weblink Category Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Link'); ?></th>
		<th><?php echo __('Hits'); ?></th>
		<th><?php echo __('Published'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($weblinkCategory['Weblink'] as $weblink): ?>
		<tr>
			<td><?php echo $weblink['id']; ?></td>
			<td><?php echo $weblink['weblink_category_id']; ?></td>
			<td><?php echo $weblink['title']; ?></td>
			<td><?php echo $weblink['description']; ?></td>
			<td><?php echo $weblink['link']; ?></td>
			<td><?php echo $weblink['hits']; ?></td>
			<td><?php echo $weblink['published']; ?></td>
			<td><?php echo $weblink['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'weblinks', 'action' => 'view', $weblink['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'weblinks', 'action' => 'edit', $weblink['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'weblinks', 'action' => 'delete', $weblink['id']), null, __('Are you sure you want to delete # %s?', $weblink['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Weblink'), array('controller' => 'weblinks', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
