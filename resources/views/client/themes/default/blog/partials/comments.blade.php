<ol class="commentlist">
    <?php foreach($comments as $comment): if ($comment->comment_approved == 1) {?>
    <li class="comment even thread-even depth-1" id="c<?php echo $comment->comment_ID; ?>">

        <div id="c<?php echo $comment->comment_ID; ?>" class="comment-body">
            <div class="comment-avatar">
                <img alt='' src='http://0.gravatar.com/avatar/00985bb63165c78152def57a37f65b9d?s=50&#038;d=mm&#038;r=g'
                     srcset='http://0.gravatar.com/avatar/00985bb63165c78152def57a37f65b9d?s=100&amp;d=mm&amp;r=g 2x'
                     class='avatar avatar-50 photo' height='50' width='50'/>
            </div>
            <div class="comment-content">
                <div class="comment-author">
                    <?php echo $comment->comment_author; ?>:
                </div>
                <div class="comment-meta">

                    <?php echo $comment->comment_date; ?>
                </div>
                <div class="comment-text">
                    <?php echo nl2br(CHtml::encode($comment->comment_content)); ?>
                </div>
                <!--<div class="reply">
                </div>-->
            </div>
        </div>
    </li><!-- #comment-## -->
    <?php } endforeach; ?>
</ol><!-- .commentlist -->