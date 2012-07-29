<div class="menus view">
<h2><?php  echo __('Menu'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Menu'); ?></dt>
		<dd>
			<?php echo $this->Html->link($menu['ParentMenu']['title'], array('controller' => 'menus', 'action' => 'view', $menu['ParentMenu']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Alias'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Published'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['published']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['level']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu'), array('action' => 'edit', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Menu'), array('action' => 'delete', $menu['Menu']['id']), null, __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Menus'); ?></h3>
	<?php if (!empty($menu['ChildMenu'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Alias'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Published'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
		<th><?php echo __('Level'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($menu['ChildMenu'] as $childMenu): ?>
		<tr>
			<td><?php echo $childMenu['id']; ?></td>
			<td><?php echo $childMenu['parent_id']; ?></td>
			<td><?php echo $childMenu['title']; ?></td>
			<td><?php echo $childMenu['alias']; ?></td>
			<td><?php echo $childMenu['type']; ?></td>
			<td><?php echo $childMenu['published']; ?></td>
			<td><?php echo $childMenu['lft']; ?></td>
			<td><?php echo $childMenu['rght']; ?></td>
			<td><?php echo $childMenu['level']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'menus', 'action' => 'view', $childMenu['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'menus', 'action' => 'edit', $childMenu['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'menus', 'action' => 'delete', $childMenu['id']), null, __('Are you sure you want to delete # %s?', $childMenu['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
