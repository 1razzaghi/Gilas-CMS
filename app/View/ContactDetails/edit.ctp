<div class="contactDetails form">
<?php echo $this->Form->create('ContactDetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Contact Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('manager');
		echo $this->Form->input('telephone_1');
		echo $this->Form->input('telephone_2');
		echo $this->Form->input('fax');
		echo $this->Form->input('mobile');
		echo $this->Form->input('sms_center');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ContactDetail.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ContactDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Contact Details'), array('action' => 'index')); ?></li>
	</ul>
</div>
