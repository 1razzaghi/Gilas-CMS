<legend>
    نظرات برای 
    <?php
    echo $this->Html->link($comments['0']['Content']['title'], array('controller' => 'contents', 'action' => 'view', $comments['0']['Content']['id'], 'admin' => TRUE));
    ?>
</legend>

<?php
echo $this->Html->script('back-end/bootstrap/jquery.simplemodal');
echo $this->Comment->showComments($comments);
?>

<script>
    $(function(){
        $('#edit').click(function (e) {
            e.preventDefault();
            var comment_id=$('#edit').attr('comment_id');

            // load the contact form using ajax
            $.get('<?php echo $this->Html->url(array('controller' => 'comments', 'action' => 'add', 'admin' => TRUE)) ?>'.comment_id, function(data){
                // create a modal dialog with the data
                $(data).modal({
                    closeHTML: "<a href='#' title='Close' class='modal-close'>x</a>",
                    position: ["15%",],
                    overlayId: 'contact-overlay',
                    containerId: 'contact-container',
                    onOpen: contact.open,
                    onShow: contact.show,
                    onClose: contact.close
                });
            });
        });
    });

</script>