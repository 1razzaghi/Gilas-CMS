<div class="weblinks form">
<?php echo $this->Form->create('Weblink'); ?>
	<fieldset>
		<legend><?php echo __('Edit Weblink'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('weblink_category_id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('link');
		echo $this->Form->input('hits');
		echo $this->Form->input('published');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Weblink.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Weblink.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Weblinks'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Weblink Categories'), array('controller' => 'weblink_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Weblink Category'), array('controller' => 'weblink_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
