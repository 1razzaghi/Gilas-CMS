<legend>لیست اطلاعات تماس</legend>
<?php echo $this->Html->link('افزودن تماس جدید', array('action' => 'add'), array('class' => 'btn btn-primary btn-large'));
?>
<p>&nbsp;</p>
<table class="table table-bordered table-striped">

    <tr>
        <th>ردیف</th>
        <th>عنوان</th>
        <th>مدیریت</th>
        <th>تلفن 1</th>
        <th>تلفن 2</th>
        <th>فکس</th>
        <th>پیام کوتاه</th>
        <th>عملیات</th>
    </tr>
    <?php
    $j = 1;
    foreach ($contactDetails as $contactDetail):
        ?>
        <tr>
            <td><?php echo $j; ?></td>
            <td><?php echo $contactDetail['ContactDetail']['title']; ?></td>
            <td><?php echo $contactDetail['ContactDetail']['manager']; ?></td>
            <td><?php echo $contactDetail['ContactDetail']['telephone_1']; ?></td>
            <td><?php echo $contactDetail['ContactDetail']['telephone_2']; ?></td>
            <td><?php echo $contactDetail['ContactDetail']['fax']; ?></td>
            <td><?php echo $contactDetail['ContactDetail']['mobile']; ?></td>
            <td><?php echo $contactDetail['ContactDetail']['sms_center']; ?></td>
            <td><?php echo $this->Form->postLink('حذف', array('action' => 'delete', $contactDetail['ContactDetail']['id'], 'admin' => TRUE), array('class' => 'btn btn-danger'), 'آیا از حذف این آیتم مطمئن هستید؟'); ?> | <?php echo $this->Html->link('ویرایش', array('action' => 'edit', $contactDetail['ContactDetail']['id'], 'admin' => TRUE), array('class' => 'btn btn-info')); ?></td>
        </tr>
        <?php
        $j++;
    endforeach;
    ?>
</table>

