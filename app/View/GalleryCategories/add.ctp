<div class="galleryCategories form">
<?php echo $this->Form->create('GalleryCategory'); ?>
	<fieldset>
		<legend><?php echo __('Add Gallery Category'); ?></legend>
	<?php
		echo $this->Form->input('parent_id');
		echo $this->Form->input('name');
		echo $this->Form->input('folder_name');
		echo $this->Form->input('published');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Gallery Categories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Gallery Categories'), array('controller' => 'gallery_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Gallery Category'), array('controller' => 'gallery_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gallery Items'), array('controller' => 'gallery_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gallery Item'), array('controller' => 'gallery_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
