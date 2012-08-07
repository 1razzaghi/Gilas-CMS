<legend>لیست تصاویر گالری</legend>

<?php
echo $this->Html->link('افزودن تصویر', array('action' => 'add', 'admin' => TRUE), array('class' => 'btn btn-primary btn-large'));
?>
<p>&nbsp;</p>
<table class="table table-bordered table-striped">

    <tr>
        <th>ردیف</th>
        <th>عنوان</th>
        <th>توضیحات</th>
        <th>آپلود کننده</th>
        <th>منتشر شده</th>
        <th>عملیات</th>
    </tr>
    <?php
    $rowNumber = 1;
    if (isset($this->params['named']['page']) && $this->params['named']['page'] > 1) {
        $rowNumber = $this->params['named']['page'] * 20 - 20 + 1;
    }
    foreach ($galleryItems as $galleryItem) :
        ?>
        <tr>
            <td><?php echo $rowNumber; ?></td>
            <td><?php echo $galleryItem['GalleryItem']['title']; ?></td>
            <td><?php echo $galleryItem['GalleryItem']['description']; ?></td>
            <td><?php echo $galleryItem['User']['name']; ?></td>
            <td>
                <?php
                if ($galleryItem['GalleryItem']['published']) {
                    $src = 'back-end/bootstrap/tick.png';
                    echo $this->Form->postLink($this->Html->image($src), array('action' => 'unPublishGalleryItem', $galleryItem['GalleryItem']['id'], 'admin' => TRUE), array('escape' => false));
                } else {
                    $src = 'back-end/bootstrap/publish_x.png';
                    echo $this->Form->postLink($this->Html->image($src), array('action' => 'publishGalleryItem', $galleryItem['GalleryItem']['id'], 'admin' => TRUE), array('escape' => false));
                }
                ?>
            </td>
            <td>
                <?php echo $this->Form->postLink('حذف', array('action' => 'delete', $galleryItem['GalleryItem']['id'], 'admin' => TRUE), array('class' => 'btn btn-danger'), 'آیا از حذف این آیتم مطمئن هستید؟'); ?> | 
                <?php echo $this->Html->link('ویرایش', array('action' => 'edit', $galleryItem['GalleryItem']['id'], 'admin' => TRUE), array('class' => 'btn btn-info')); ?>
            </td>
        </tr>
        <?php
        $rowNumber++;
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
