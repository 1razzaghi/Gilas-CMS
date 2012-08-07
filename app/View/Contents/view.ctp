<div class="contents view">
    <h2><?php echo __('Content'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($content['Content']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('User'); ?></dt>
        <dd>
            <?php echo $this->Html->link($content['User']['name'], array('controller' => 'users', 'action' => 'view', $content['User']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Content Category'); ?></dt>
        <dd>
            <?php echo $this->Html->link($content['ContentCategory']['name'], array('controller' => 'content_categories', 'action' => 'view', $content['ContentCategory']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Title'); ?></dt>
        <dd>
            <?php echo h($content['Content']['title']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Slug'); ?></dt>
        <dd>
            <?php echo h($content['Content']['slug']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Content'); ?></dt>
        <dd>
            <?php echo h($content['Content']['content']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Frontpage'); ?></dt>
        <dd>
            <?php echo h($content['Content']['frontpage']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Published'); ?></dt>
        <dd>
            <?php echo h($content['Content']['published']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($content['Content']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($content['Content']['modified']); ?>
            &nbsp;
        </dd>
    </dl>
    <?php if ($content['Content']['allow_comment']): ?>
        <div id="comment">
            <legend>افزودن نظر</legend>
            <?php
            echo $this->Form->create('Comment');
            echo $this->Form->input('name', array('label' => 'نام'));
            echo $this->Form->input('email', array('label' => 'پست الکترونیک'));
            echo $this->Form->input('website', array('label' => 'وبسایت'));
            echo $this->Form->input('content', array('label' => 'متن'));
            ?>
            <input type="submit" value="ذخیره" class="btn btn-success" />
        </div>
    <?php endif; ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Content'), array('action' => 'edit', $content['Content']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Content'), array('action' => 'delete', $content['Content']['id']), null, __('Are you sure you want to delete # %s?', $content['Content']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Contents'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Content'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Content Categories'), array('controller' => 'content_categories', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Content Category'), array('controller' => 'content_categories', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
    </ul>
</div>
<div class="related">
    <h3><?php echo __('Related Comments'); ?></h3>
    <?php if (!empty($content['Comment'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Id'); ?></th>
                <th><?php echo __('Parent Id'); ?></th>
                <th><?php echo __('Content Id'); ?></th>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Email'); ?></th>
                <th><?php echo __('Website'); ?></th>
                <th><?php echo __('Content'); ?></th>
                <th><?php echo __('Published'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php
            $i = 0;
            foreach ($content['Comment'] as $comment):
                ?>
                <tr>
                    <td><?php echo $comment['id']; ?></td>
                    <td><?php echo $comment['parent_id']; ?></td>
                    <td><?php echo $comment['content_id']; ?></td>
                    <td><?php echo $comment['name']; ?></td>
                    <td><?php echo $comment['email']; ?></td>
                    <td><?php echo $comment['website']; ?></td>
                    <td><?php echo $comment['content']; ?></td>
                    <td><?php echo $comment['published']; ?></td>
                    <td><?php echo $comment['created']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['id']), null, __('Are you sure you want to delete # %s?', $comment['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
        </ul>
    </div>
</div>
