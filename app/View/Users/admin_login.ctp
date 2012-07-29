<?php echo $this->Html->image('back-end/logo.png', array('class' => 'logo')); ?>
<?php echo $this->Session->flash('auth', array('params' => array('class' => 'alert alert-error'))); ?>
<?php
echo $this->Form->create('User', array('action' => 'login'));
echo $this->Form->input('username', array('label' => 'نام کاربری'));
echo $this->Form->input('password', array('label' => 'کلمه عبور'));
?>
<input type="submit" name="" value="ورود به سیستم" class="btn btn-primary btn-large" />
<a href="register" class="btn btn-large">ثبت نام در سیستم</a>