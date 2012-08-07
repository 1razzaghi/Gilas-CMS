<div class="contentCategories form">
    <?php
    echo $this->Form->create('GalleryCategory', array(
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
        <legend><?php echo __('افزودن مجموعه'); ?></legend>
        <?php
        echo $this->Form->input('parent_id', array('label' => 'مجموعه مرجع'));
        echo $this->Form->input('name', array('label' => 'نام مجموعه'));
        echo $this->Form->input('folder_name', array('label' => 'نام پوشه برای ذخیره تصاویر'));
        ?>
        <div>
            <label>منتشر شده</label>
            <input type="radio" name="data[GalleryCategory][published]" value="1" <?php if ($this->Form->value('GalleryCategory.published') == 1) echo 'checked=""' ?> /> بله
            <input type="radio" name="data[GalleryCategory][published]" value="0" <?php if ($this->Form->value('GalleryCategory.published') == 0) echo 'checked=""' ?> /> خیر
        </div>
    </fieldset>
    <input type="submit" value="ذخیره" class="btn btn-success" />
    <?php
    echo $this->Html->link('انصراف', array('action' => 'index', 'admin' => TRUE), array('class' => 'btn btn-danger'));
    echo $this->Form->end();
    ?>
</div>
