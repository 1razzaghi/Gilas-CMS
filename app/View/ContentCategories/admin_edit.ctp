<div class="contentCategories form">
    <?php
    echo $this->Form->create('ContentCategory', array(
        'inputDefaults' => array(
            'error' => array(
                'attributes' => array(
                    'class' => 'alert alert-error',
                    'id' => 'msg'
                )
            ),
            'empty' => array(
                0 => '--- بدون مرجع ---'
            )
        )
    ));
    ?>
    <fieldset>
        <legend><?php echo __('ویرایش مجموعه'); ?></legend>
        <?php
        echo $this->Form->input('parent_id', array('label' => 'مجموعه مرجع'));
        echo $this->Form->input('name', array('lasbel' => 'نام مجموعه'));
        ?>
    </fieldset>
    <input type="submit" value="ذخیره" class="btn btn-success" />
    <?php
    echo $this->Html->link('انصراف', array('action' => 'index', 'admin' => TRUE), array('class' => 'btn btn-danger'));
    echo $this->Form->end();
    ?>
</div>
