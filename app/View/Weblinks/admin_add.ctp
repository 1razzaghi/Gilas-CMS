<legend>افزودن وب لینک</legend>
<?php
echo $this->Form->create('Weblink');
echo $this->Form->input('weblink_category_id', array('label' => 'مجموعه', 'empty' => array(0 => '--- انتخاب مجموعه ---'), 'error' => array('attributes' => array('class' => 'alert alert-error', 'id' => 'msg'))));
echo $this->Form->input('title', array('label' => 'عنوان', 'error' => array('attributes' => array('class' => 'alert alert-error', 'id' => 'msg'))));
echo $this->Form->input('description', array('label' => 'توضیحات'));
echo $this->Form->input('address', array('label' => 'آدرس وب', 'error' => array('attributes' => array('class' => 'alert alert-error', 'id' => 'msg'))));
?>
<div>
    <label>منتشر شده</label>
    <input type="radio" name="data[Content][published]" value="1" <?php if ($this->Form->value('Content.published') == 1) echo 'checked=""' ?> /> بله
    <input type="radio" name="data[Content][published]" value="0" <?php if ($this->Form->value('Content.published') == 0) echo 'checked=""' ?> /> خیر
</div>
<br />
<input type="submit" value="ذخیره" class="btn btn-success" />
<?php echo $this->Html->link('انصراف', array('action' => 'index', 'admin' => TRUE), array('class' => 'btn btn-danger')); ?>
