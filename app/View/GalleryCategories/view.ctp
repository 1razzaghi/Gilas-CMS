<div class="galleryCategories view">
<h2><?php  echo __('Gallery Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($galleryCategory['GalleryCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Gallery Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($galleryCategory['ParentGalleryCategory']['name'], array('controller' => 'gallery_categories', 'action' => 'view', $galleryCategory['ParentGalleryCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($galleryCategory['GalleryCategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Folder Name'); ?></dt>
		<dd>
			<?php echo h($galleryCategory['GalleryCategory']['folder_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Published'); ?></dt>
		<dd>
			<?php echo h($galleryCategory['GalleryCategory']['published']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Gallery Category'), array('action' => 'edit', $galleryCategory['GalleryCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Gallery Category'), array('action' => 'delete', $galleryCategory['GalleryCategory']['id']), null, __('Are you sure you want to delete # %s?', $galleryCategory['GalleryCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Gallery Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gallery Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gallery Categories'), array('controller' => 'gallery_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Gallery Category'), array('controller' => 'gallery_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Gallery Items'), array('controller' => 'gallery_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gallery Item'), array('controller' => 'gallery_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Gallery Categories'); ?></h3>
	<?php if (!empty($galleryCategory['ChildGalleryCategory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Folder Name'); ?></th>
		<th><?php echo __('Published'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($galleryCategory['ChildGalleryCategory'] as $childGalleryCategory): ?>
		<tr>
			<td><?php echo $childGalleryCategory['id']; ?></td>
			<td><?php echo $childGalleryCategory['parent_id']; ?></td>
			<td><?php echo $childGalleryCategory['name']; ?></td>
			<td><?php echo $childGalleryCategory['folder_name']; ?></td>
			<td><?php echo $childGalleryCategory['published']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'gallery_categories', 'action' => 'view', $childGalleryCategory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'gallery_categories', 'action' => 'edit', $childGalleryCategory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'gallery_categories', 'action' => 'delete', $childGalleryCategory['id']), null, __('Are you sure you want to delete # %s?', $childGalleryCategory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Gallery Category'), array('controller' => 'gallery_categories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Gallery Items'); ?></h3>
	<?php if (!empty($galleryCategory['GalleryItem'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Gallery Category Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Published'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($galleryCategory['GalleryItem'] as $galleryItem): ?>
		<tr>
			<td><?php echo $galleryItem['id']; ?></td>
			<td><?php echo $galleryItem['user_id']; ?></td>
			<td><?php echo $galleryItem['gallery_category_id']; ?></td>
			<td><?php echo $galleryItem['title']; ?></td>
			<td><?php echo $galleryItem['name']; ?></td>
			<td><?php echo $galleryItem['description']; ?></td>
			<td><?php echo $galleryItem['published']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'gallery_items', 'action' => 'view', $galleryItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'gallery_items', 'action' => 'edit', $galleryItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'gallery_items', 'action' => 'delete', $galleryItem['id']), null, __('Are you sure you want to delete # %s?', $galleryItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Gallery Item'), array('controller' => 'gallery_items', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
