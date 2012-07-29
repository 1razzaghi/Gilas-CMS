<div class="weblinks view">
<h2><?php  echo __('Weblink'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($weblink['Weblink']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weblink Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($weblink['WeblinkCategory']['name'], array('controller' => 'weblink_categories', 'action' => 'view', $weblink['WeblinkCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($weblink['Weblink']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($weblink['Weblink']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Link'); ?></dt>
		<dd>
			<?php echo h($weblink['Weblink']['link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hits'); ?></dt>
		<dd>
			<?php echo h($weblink['Weblink']['hits']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Published'); ?></dt>
		<dd>
			<?php echo h($weblink['Weblink']['published']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($weblink['Weblink']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Weblink'), array('action' => 'edit', $weblink['Weblink']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Weblink'), array('action' => 'delete', $weblink['Weblink']['id']), null, __('Are you sure you want to delete # %s?', $weblink['Weblink']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Weblinks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Weblink'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Weblink Categories'), array('controller' => 'weblink_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Weblink Category'), array('controller' => 'weblink_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
