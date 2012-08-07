<legend>افزودن مجموعه وب لینک</legend>

<?php
echo $this->Form->create('WeblinkCategory');
echo $this->Form->input('name', array('label' => 'نام مجموعه', 'error' => array('attributes' => array('class' => 'alert alert-error', 'id' => 'msg'))));
?>
<input type="submit" value="ذخیره" class="btn btn-success" />
<?php echo $this->Html->link('انصراف', array('action' => 'index', 'admin' => TRUE), array('class' => 'btn btn-danger')); ?>