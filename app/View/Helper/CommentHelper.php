<?php
/*
 * Created By : Mohammad Razzaghi
 * Email : 1razzaghi@gmail.com
 * Blog : http://bigitblog.ir
 * Social Networks : 
 *          http://facebook.com/1razzaghi
 *          http://twitter.com/1razzaghi
 */

class CommentHelper extends AppHelper {

    public $helpers = array('Html', 'Form');

    private function _haveChild(array $inComment) {
        if ($inComment['children'] != NULL) {
            $this->showComments($inComment['children']);
        }
    }

    public function showComments(array $comments) {
        foreach ($comments as $comment) {
            ?>
            <blockquote>
                <?php
                if ($comment['Comment']['published']) {
                    ?>
                    <span class="label label-success">منتشر شده</span>
                    <?php
                } else {
                    ?>
                    <span class="label label-important">منتشر نشده</span>
                    <?php
                }
                ?>

                <small>نوشته شده توسط : 
                    <?php echo $comment['Comment']['name'] ?> در 
                    <?php echo Jalali::niceShort($comment['Comment']['created']); ?>
                </small>
                <small>
                    <?php
                    if (!empty($comment['Comment']['website']))
                        echo $this->Html->link('وبسایت', $comment['Comment']['website'], array('target' => '_blank'));
                    else
                        echo 'وبسایت';
                    ?> | 
                    <?php
                    if (!empty($comment['Comment']['email']))
                        echo $this->Html->link('پست الکترونیک', 'mailto:' . $comment['Comment']['email']);
                    else
                        echo 'پست الکترونیک';
                    ?>
                </small>
                <?php echo $comment['Comment']['content'] ?>
                <div style="float: left">
                    <?php
                    if ($comment['Comment']['published'])
                        echo $this->Form->postLink('عدم انتشار', array('action' => 'unpublish_comment', $comment['Comment']['id'], 'admin' => TRUE), array('class' => 'btn btn-warning'));
                    else
                        echo $this->Form->postLink('انتشار', array('action' => 'publish_comment', $comment['Comment']['id'], 'admin' => TRUE), array('class' => 'btn btn-success'));
                    ?> | 
                    <?php echo $this->Html->link('ویرایش', '#', array('class' => 'btn btn-info', 'id' => 'edit', 'comment_id' => $comment['Comment']['id'])); ?> |
                    <?php echo $this->Form->postLink('حذف', array('action' => 'delete', $comment['Comment']['id'], 'admin' => TRUE), array('class' => 'btn btn-danger'), 'آیا از حذف این آیتم مطمئن هستید؟'); ?>
                </div>
                <hr />
                <?php $this->_haveChild($comment); ?>

            </blockquote>

            <?php
        }
    }

}
?>
