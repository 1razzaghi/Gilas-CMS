<div class="galleryCategories index">
	<h2><?php echo __('Gallery Categories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('folder_name'); ?></th>
			<th><?php echo $this->Paginator->sort('published'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($galleryCategories as $galleryCategory): ?>
	<tr>
		<td><?php echo h($galleryCategory['GalleryCategory']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($galleryCategory['ParentGalleryCategory']['name'], array('controller' => 'gallery_categories', 'action' => 'view', $galleryCategory['ParentGalleryCategory']['id'])); ?>
		</td>
		<td><?php echo h($galleryCategory['GalleryCategory']['name']); ?>&nbsp;</td>
		<td><?php echo h($galleryCategory['GalleryCategory']['folder_name']); ?>&nbsp;</td>
		<td><?php echo h($galleryCategory['GalleryCategory']['published']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $galleryCategory['GalleryCategory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $galleryCategory['GalleryCategory']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $galleryCategory['GalleryCategory']['id']), null, __('Are you sure you want to delete # %s?', $galleryCategory['GalleryCategory']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Gallery Category'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Gallery Categories'), array('controller' => 'gallery_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Gallery Category'), array('controller' => 'gallery_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gallery Items'), array('controller' => 'gallery_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gallery Item'), array('controller' => 'gallery_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
