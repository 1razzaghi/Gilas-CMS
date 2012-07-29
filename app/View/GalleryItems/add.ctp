<div class="galleryItems form">
<?php echo $this->Form->create('GalleryItem'); ?>
	<fieldset>
		<legend><?php echo __('Add Gallery Item'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('gallery_category_id');
		echo $this->Form->input('title');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('published');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Gallery Items'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gallery Categories'), array('controller' => 'gallery_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gallery Category'), array('controller' => 'gallery_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
