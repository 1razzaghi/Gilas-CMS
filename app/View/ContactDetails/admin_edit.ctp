<legend>ویرایش اطلاعات تماس</legend>
<?php
echo $this->Form->create('ContactDetail', array(
    'inputDefaults' => array(
        'error' => array(
            'attributes' => array(
                'class' => 'alert alert-error',
                'id' => 'msg'
            )
        )
    )
));
echo $this->Form->input('title', array('label' => 'عنوان'));
echo $this->Form->input('manager', array('label' => 'مدیریت'));
echo $this->Form->input('telephone_1', array('label' => 'تلفن 1'));
echo $this->Form->input('telephone_2', array('label' => 'تلفن 2'));
echo $this->Form->input('fax', array('label' => 'فکس'));
echo $this->Form->input('mobile', array('label' => 'موبایل'));
echo $this->Form->input('sms_center', array('label' => 'پیام کوتاه'));
?>
<input type="submit" value="ذخیره" class="btn btn-success" />
<?php
echo $this->Html->link('انصراف', array('action' => 'index', 'admin' => TRUE), array('class' => 'btn btn-danger'));
echo $this->Form->end();
?>