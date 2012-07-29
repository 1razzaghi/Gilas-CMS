<div class="weblinkCategories form">
<?php echo $this->Form->create('WeblinkCategory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Weblink Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('WeblinkCategory.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('WeblinkCategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Weblink Categories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Weblink Categories'), array('controller' => 'weblink_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Weblink Category'), array('controller' => 'weblink_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Weblinks'), array('controller' => 'weblinks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Weblink'), array('controller' => 'weblinks', 'action' => 'add')); ?> </li>
	</ul>
</div>
