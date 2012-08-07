<legend>لیست وب لینک ها</legend>
<?php
echo $this->Html->link('افزودن وب لینک', array('action' => 'add'), array('class' => 'btn btn-primary btn-large'));
?>
<p>&nbsp;</p>
<table class="table table-bordered table-striped">

    <tr>
        <th>ردیف</th>
        <th>عنوان</th>
        <th id="grid-align">مجموعه</th>
        <th>آدرس وب</th>
        <th id="grid-align">منتشر شده</th>
        <th id="grid-align">عملیات</th>
    </tr>
    <?php
    $j = 1;
    if (isset($this->params['named']['page']) && $this->params['named']['page'] > 1) {
        $j = $this->params['named']['page'] * 20 - 20 + 1;
    }
    foreach ($weblinks as $weblink):
        ?>
        <tr>
            <td><?php echo $j; ?></td>
            <td><?php echo $weblink['Weblink']['title']; ?></td>
            <td id="grid-align"><?php echo $weblink['WeblinkCategory']['name']; ?></td>
            <td><?php echo $weblink['Weblink']['address']; ?></td>
            <td id="grid-align">
                <?php
                if ($weblink['Weblink']['published'])
                    $src = 'back-end/bootstrap/tick.png';
                else
                    $src = 'back-end/bootstrap/publish_x.png';
                echo $this->Html->image($src);
                ?>
            </td>
            <td id="grid-align"><?php echo $this->Form->postLink('حذف', array('action' => 'delete', $weblink['Weblink']['id'], 'admin' => TRUE), array('class' => 'btn btn-danger'), 'آیا از حذف این آیتم مطمئن هستید؟'); ?> | <?php echo $this->Html->link('ویرایش', array('action' => 'edit', $weblink['Weblink']['id'], 'admin' => TRUE), array('class' => 'btn btn-info')); ?></td>
        </tr>
        <?php
        $j++;
    endforeach;
    ?>
</table>
<br />
<div class="container">
    <div class="btn-group">
        <?php
        echo $this->Paginator->numbers(array('tag' => 'span', 'class' => 'btn', 'separator' => NULL, 'first' => 'ابتدا', 'last' => 'انتها'));
        ?>
    </div>
</div>
