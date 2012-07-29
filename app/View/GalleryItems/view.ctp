<div class="galleryItems view">
<h2><?php  echo __('Gallery Item'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($galleryItem['GalleryItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($galleryItem['User']['name'], array('controller' => 'users', 'action' => 'view', $galleryItem['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gallery Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($galleryItem['GalleryCategory']['name'], array('controller' => 'gallery_categories', 'action' => 'view', $galleryItem['GalleryCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($galleryItem['GalleryItem']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($galleryItem['GalleryItem']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($galleryItem['GalleryItem']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Published'); ?></dt>
		<dd>
			<?php echo h($galleryItem['GalleryItem']['published']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Gallery Item'), array('action' => 'edit', $galleryItem['GalleryItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Gallery Item'), array('action' => 'delete', $galleryItem['GalleryItem']['id']), null, __('Are you sure you want to delete # %s?', $galleryItem['GalleryItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Gallery Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gallery Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gallery Categories'), array('controller' => 'gallery_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gallery Category'), array('controller' => 'gallery_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
