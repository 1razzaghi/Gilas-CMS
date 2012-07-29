<div class="contactDetails view">
<h2><?php  echo __('Contact Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($contactDetail['ContactDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($contactDetail['ContactDetail']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Manager'); ?></dt>
		<dd>
			<?php echo h($contactDetail['ContactDetail']['manager']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telephone 1'); ?></dt>
		<dd>
			<?php echo h($contactDetail['ContactDetail']['telephone_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telephone 2'); ?></dt>
		<dd>
			<?php echo h($contactDetail['ContactDetail']['telephone_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax'); ?></dt>
		<dd>
			<?php echo h($contactDetail['ContactDetail']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile'); ?></dt>
		<dd>
			<?php echo h($contactDetail['ContactDetail']['mobile']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sms Center'); ?></dt>
		<dd>
			<?php echo h($contactDetail['ContactDetail']['sms_center']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contact Detail'), array('action' => 'edit', $contactDetail['ContactDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Contact Detail'), array('action' => 'delete', $contactDetail['ContactDetail']['id']), null, __('Are you sure you want to delete # %s?', $contactDetail['ContactDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contact Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contact Detail'), array('action' => 'add')); ?> </li>
	</ul>
</div>
