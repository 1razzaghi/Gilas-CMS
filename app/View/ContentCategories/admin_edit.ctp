<div class="contentCategories form">
    <?php echo $this->Form->create('ContentCategory'); ?>
    <fieldset>
        <legend><?php echo __('ویرایش مجموعه'); ?></legend>
        <?php
        echo $this->Form->input('parent_id', array('label' => 'مجموعه مرجع'));
        echo $this->Form->input('name', array('lasbel' => 'نام مجموعه'));
        ?>
    </fieldset>
    <input type="submit" value="ذخیره" class="btn btn-success" />
    <?php echo $this->Html->link('انصراف', array('action' => 'index', 'admin' => TRUE), array('class' => 'btn btn-danger')); ?>
</div>
