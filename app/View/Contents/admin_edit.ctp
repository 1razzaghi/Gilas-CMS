<legend>ویرایش مطلب</legend>
<?php
echo $this->Form->create('Content', array(
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
    )
));
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
<div>
    <label>نظردهی به مطلب</label>
    <input type="radio" name="data[Content][allow_comment]" value="1" <?php if ($this->Form->value('Content.allow_comment') == 1) echo 'checked=""' ?> /> فعال
    <input type="radio" name="data[Content][allow_comment]" value="0" <?php if ($this->Form->value('Content.allow_comment') == 0) echo 'checked=""' ?> /> غیرفعال
</div>
<div>
    <label>نمایش نظرات</label>
    <input type="radio" name="data[Content][published_comment]" value="1" <?php if ($this->Form->value('Content.published_comment') == 1) echo 'checked=""' ?> /> بلافاصله نمایش داده شوند
    <input type="radio" name="data[Content][published_comment]" value="0" <?php if ($this->Form->value('Content.published_comment') == 0) echo 'checked=""' ?> /> خیر، پس از تایید نمایش داده شوند
</div>
<?php
$this->TinyMCE->editor('advanced');
echo $this->Form->input('content', array('label' => 'متن', 'class' => 'tinymce'));
?>
<br />
<input type="submit" value="ذخیره" class="btn btn-success" />
<?php
echo $this->Html->link('انصراف', array('action' => 'index', 'admin' => TRUE), array('class' => 'btn btn-danger'));
echo $this->Form->end();
?>