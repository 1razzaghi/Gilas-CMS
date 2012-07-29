<div class="galleryItems index">
	<h2><?php echo __('Gallery Items'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('gallery_category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('published'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($galleryItems as $galleryItem): ?>
	<tr>
		<td><?php echo h($galleryItem['GalleryItem']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($galleryItem['User']['name'], array('controller' => 'users', 'action' => 'view', $galleryItem['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($galleryItem['GalleryCategory']['name'], array('controller' => 'gallery_categories', 'action' => 'view', $galleryItem['GalleryCategory']['id'])); ?>
		</td>
		<td><?php echo h($galleryItem['GalleryItem']['title']); ?>&nbsp;</td>
		<td><?php echo h($galleryItem['GalleryItem']['name']); ?>&nbsp;</td>
		<td><?php echo h($galleryItem['GalleryItem']['description']); ?>&nbsp;</td>
		<td><?php echo h($galleryItem['GalleryItem']['published']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $galleryItem['GalleryItem']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $galleryItem['GalleryItem']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $galleryItem['GalleryItem']['id']), null, __('Are you sure you want to delete # %s?', $galleryItem['GalleryItem']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Gallery Item'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gallery Categories'), array('controller' => 'gallery_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gallery Category'), array('controller' => 'gallery_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
