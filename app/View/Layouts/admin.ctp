<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('back-end/bootstrap/bootstrap-rtl.min');
        echo $this->Html->css('back-end/bootstrap/bootstrap-responsive-rtl.min');
        echo $this->Html->css('back-end/bootstrap/template');
        echo $this->Html->script('back-end/bootstrap/jquery');
        echo $this->Html->script('back-end/bootstrap/bootstrap');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <?php echo $this->Html->link($this->Html->image('back-end/logo-small.png'), array('controller' => 'dashboards', 'action' => 'index', 'admin' => TRUE), array('class' => 'brand', 'escape' => false)); ?>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">مطالب
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('مدیریت مطالب', array('controller' => 'contents', 'action' => 'index', 'admin' => TRUE)); ?></li>
                                    <li><?php echo $this->Html->link('مدیریت مجموعه مطالب', array('controller' => 'content_categories', 'action' => 'index', 'admin' => TRUE), array('class' => 'active')); ?></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">وب لینک ها
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('مدیریت وب لینک ها', array('controller' => 'weblinks', 'action' => 'index', 'admin' => TRUE)); ?></li>
                                    <li><?php echo $this->Html->link('مدیریت مجموعه وب لینک', array('controller' => 'weblink_categories', 'action' => 'index', 'admin' => TRUE), array('class' => 'active')); ?></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">گالری تصاویر
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link('مدیریت تصاویر', array('controller' => 'gallery_items', 'action' => 'index', 'admin' => TRUE)); ?></li>
                                    <li><?php echo $this->Html->link('مدیریت مجموعه گالری تصاویر', array('controller' => 'gallery_categories', 'action' => 'index', 'admin' => TRUE), array('class' => 'active')); ?></li>
                                </ul>
                            </li>
                            <li><?php echo $this->Html->link('مدیریت تماس ها', array('controller' => 'contact_details', 'action' => 'index', 'admin' => TRUE)); ?></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                    <div class="user-info">
                        <span>سلام</span>
                        <?php echo $_SESSION['Auth']['User']['name'] ?>
                        <?php echo $this->Html->link('خروج', array('controller' => 'users', 'action' => 'logout', 'admin' => TRUE)); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="top">
                <div id="flash_message"><?php echo $this->Session->flash('flash', array('element' => 'message')); ?></div>
                <div id="flash_message"><?php echo $this->Session->flash('flash', array('element' => 'message_1')); ?></div>
            </div>
            <div id="content"><?php echo $this->fetch('content'); ?></div>
            <div id="footer"><pre><?php echo $this->element('sql_dump'); ?></pre></div>
        </div>
    </body>
</html>