<div class="sliderItems form">
<?php echo $this->Form->create('SliderItem'); ?>
	<fieldset>
		<legend><?php echo __('Add Slider Item'); ?></legend>
	<?php
		echo $this->Form->input('link');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('name');
		echo $this->Form->input('published');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Slider Items'), array('action' => 'index')); ?></li>
	</ul>
</div>
