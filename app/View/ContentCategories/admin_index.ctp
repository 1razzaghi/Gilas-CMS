<legend>لیست مجموعه ها</legend>
<?php echo $this->Html->link('افزودن مجموعه مطلب', array('action' => 'add'), array('class' => 'btn btn-primary btn-large'));
?>
<p>&nbsp;</p>
<table class="table table-bordered table-striped">

    <tr>
        <th>ردیف</th>
        <th>نام</th>
        <th>عملیات</th>
    </tr>
    <?php
    $j = 1;
    if (isset($this->params['named']['page']) && $this->params['named']['page'] > 1) {
        $j = $this->params['named']['page'] * 20 - 20 + 1;
    }
    foreach ($contentCategories as $contentCategory):
        ?>
        <tr>
            <td><?php echo $j; ?></td>
            <td><?php echo $contentCategory['ContentCategory']['name']; ?></td>
            <td><?php echo $this->Form->postLink('حذف', array('action' => 'delete', $contentCategory['ContentCategory']['id'], 'admin' => TRUE), array('class' => 'btn btn-danger'), 'آیا از حذف این آیتم مطمئن هستید؟'); ?> | <?php echo $this->Html->link('ویرایش', array('action' => 'edit', $contentCategory['ContentCategory']['id'], 'admin' => TRUE), array('class' => 'btn btn-info')); ?></td>
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
