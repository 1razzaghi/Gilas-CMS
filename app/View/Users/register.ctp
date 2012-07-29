<legend>ثبت نام در سیستم</legend>
<?php
echo $this->Form->create('User');
echo $this->Form->input('name', array('label' => 'نام و نام خانوادگی', 'error' => array('attributes' => array('class' => 'alert alert-error'))));
echo $this->Form->input('username', array('label' => 'نام کاربری', 'error' => array('attributes' => array('class' => 'alert alert-error'))));
echo $this->Form->input('password', array('label' => 'کلمه عبور', 'error' => array('attributes' => array('class' => 'alert alert-error'))));
echo $this->Form->input('email', array('label' => 'پست الکترونیک', 'error' => array('attributes' => array('class' => 'alert alert-error'))));
?>
<input type="submit" name="" value="ثبت نام" class="btn btn-success btn-large" />