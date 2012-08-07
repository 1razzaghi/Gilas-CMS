<legend>افزودن تصویر به گالری</legend>
<?php
echo $this->Form->create('GalleryItem', array(
    'inputDefaults' => array(
        'error' => array(
            'attributes' => array(
                'class' => 'alert alert-error',
                'id' => 'msg'
            )
        ),
        'empty' => array(
            0 => '--- انتخاب مجموعه ---'
        )
    ),
    'type' => 'file'
));
echo $this->Form->input('title', array('label' => 'عنوان تصویر'));
echo $this->Form->input('gallery_category_id', array('label' => 'مجموعه گالری'));
echo $this->Form->input('name', array('label' => 'انتخاب فایل', 'type' => 'file'));
echo $this->Form->input('description', array('label' => 'توضیحات'));
?>
<div>
    <label>منتشر شده</label>
    <input type="radio" name="data[GalleryItem][published]" value="1" <?php if ($this->Form->value('GalleryItem.published') == 1) echo 'checked=""' ?> /> بله
    <input type="radio" name="data[GalleryItem][published]" value="0" <?php if ($this->Form->value('GalleryItem.published') == 0) echo 'checked=""' ?> /> خیر
</div>
<br/>
<input type="submit" value="ذخیره" class="btn btn-success" />
<?php
echo $this->Html->link('انصراف', array('action' => 'index', 'admin' => TRUE), array('class' => 'btn btn-danger'));
echo $this->Form->end();
?>