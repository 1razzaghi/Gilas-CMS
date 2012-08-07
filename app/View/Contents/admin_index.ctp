<legend>لیست مطالب</legend>
<?php
echo $this->Html->link('افزودن مطلب', array('action' => 'add'), array('class' => 'btn btn-primary btn-large'));
//debug($contents);
?>
<p>&nbsp;</p>
<table class="table table-bordered table-striped">

    <tr>
        <th>ردیف</th>
        <th>عنوان</th>
        <th id="grid-align">مجموعه</th>
        <th id="grid-align">منتشر شده</th>
        <th id="grid-align">صفحه نخست</th>
        <th id="grid-align">نظر دهی</th>
        <th id="grid-align">نویسنده</th>
        <th id="grid-align">آخرین ویرایش</th>
        <th id="grid-align">عملیات</th>
    </tr>
    <?php
    $j = 1;
    if (isset($this->params['named']['page']) && $this->params['named']['page'] > 1) {
        $j = $this->params['named']['page'] * 20 - 20 + 1;
    }
    foreach ($contents as $content):
        ?>
        <tr>
            <td><?php echo $j; ?></td>
            <td><?php echo $content['Content']['title']; ?></td>
            <td id="grid-align"><?php echo $content['ContentCategory']['name']; ?></td>
            <td id="grid-align">
                <?php
                if ($content['Content']['published']) {
                    $src = 'back-end/bootstrap/tick.png';
                    echo $this->Form->postLink($this->Html->image($src), array('action' => 'unpublish_content', $content['Content']['id'], 'admin' => TRUE), array('escape' => false));
                } else {
                    $src = 'back-end/bootstrap/publish_x.png';
                    echo $this->Form->postLink($this->Html->image($src), array('action' => 'publish_content', $content['Content']['id'], 'admin' => TRUE), array('escape' => false));
                }


                //echo $this->Html->image($src);
                ?>
            </td>
            <td id="grid-align">
                <?php
                if ($content['Content']['frontpage']) {
                    $src = 'back-end/bootstrap/tick.png';
                    echo $this->Form->postLink($this->Html->image($src), array('action' => 'remove_content_from_frontpage', $content['Content']['id'], 'admin' => TRUE), array('escape' => false));
                } else {
                    $src = 'back-end/bootstrap/publish_x.png';
                    echo $this->Form->postLink($this->Html->image($src), array('action' => 'add_content_to_frontpage', $content['Content']['id'], 'admin' => TRUE), array('escape' => false));
                }
                ?>
            </td>
            <td id="grid-align">
                <?php
                if ($content['Content']['allow_comment']) {
                    $src = 'back-end/bootstrap/tick.png';
                    echo $this->Form->postLink($this->Html->image($src), array('action' => 'dis_allow_comment_to_content', $content['Content']['id'], 'admin' => TRUE), array('escape' => false));
                } else {
                    $src = 'back-end/bootstrap/publish_x.png';
                    echo $this->Form->postLink($this->Html->image($src), array('action' => 'allow_comment_to_content', $content['Content']['id'], 'admin' => TRUE), array('escape' => false));
                }
                ?>
            </td>
            <td id="grid-align"><?php echo $content['User']['name']; ?></td>
            <td id="grid-align"><?php echo Jalali::niceShort($content['Content']['modified']); ?></td>
            <td id="grid-align">
                <?php echo $this->Form->postLink('حذف', array('action' => 'delete', $content['Content']['id'], 'admin' => TRUE), array('class' => 'btn btn-danger'), 'آیا از حذف این آیتم مطمئن هستید؟'); ?> | 
                <?php echo $this->Html->link('ویرایش', array('action' => 'edit', $content['Content']['id'], 'admin' => TRUE), array('class' => 'btn btn-info')); ?> | 
                <?php echo $this->Html->link('نظرات', array('controller' => 'comments', 'action' => 'view', $content['Content']['id'], 'admin' => TRUE), array('class' => 'btn')); ?>
            </td>
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
