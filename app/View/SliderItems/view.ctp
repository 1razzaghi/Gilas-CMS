<div class="sliderItems view">
<h2><?php  echo __('Slider Item'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sliderItem['SliderItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Link'); ?></dt>
		<dd>
			<?php echo h($sliderItem['SliderItem']['link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($sliderItem['SliderItem']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($sliderItem['SliderItem']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($sliderItem['SliderItem']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Published'); ?></dt>
		<dd>
			<?php echo h($sliderItem['SliderItem']['published']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($sliderItem['SliderItem']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Slider Item'), array('action' => 'edit', $sliderItem['SliderItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Slider Item'), array('action' => 'delete', $sliderItem['SliderItem']['id']), null, __('Are you sure you want to delete # %s?', $sliderItem['SliderItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Slider Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Slider Item'), array('action' => 'add')); ?> </li>
	</ul>
</div>
