<legend>افزودن مطلب</legend>
<?php
echo $this->Form->create('Content');
echo $this->Form->input('title', array('label' => 'عنوان مطلب'));
echo $this->Form->input('slug', array('label' => 'نام مستعار'));
echo $this->Form->input('content_category_id', array('label' => 'مجموعه'));
?>
<div>
    <label>منتشر شده</label>
    <input type="radio" name="data[Content][published]" value="1" <?php if ($this->Form->value('Content.published') == 1) echo 'checked=""' ?> /> بله
    <input type="radio" name="data[Content][published]" value="0" <?php if ($this->Form->value('Content.published') == 0) echo 'checked=""' ?> /> خیر
</div>
<div>
    <label>صفحه نخست</label>
    <input type="radio" name="data[Content][frontpage]" value="1" <?php if ($this->Form->value('Content.frontpage') == 1) echo 'checked=""' ?> /> بله
    <input type="radio" name="data[Content][frontpage]" value="0" <?php if ($this->Form->value('Content.frontpage') == 0) echo 'checked=""' ?> /> خیر
</div>
<?php
$this->TinyMCE->editor('simple');
echo $this->Form->input('content', array('class' => 'tinymce','label' => 'متن'));
?>
<br />
<input type="submit" value="ذخیره" class="btn btn-success" />
<?php echo $this->Html->link('انصراف', array('action' => 'index', 'admin' => TRUE), array('class' => 'btn btn-danger')); ?>