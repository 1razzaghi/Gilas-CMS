<div class="contactDetails form">
<?php echo $this->Form->create('ContactDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Contact Detail'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Contact Details'), array('action' => 'index')); ?></li>
	</ul>
</div>
