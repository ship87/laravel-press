<?php
/**
 * @var $post App\Common\Blog\Models\Post
 */
?>
<div class="comments-wrap row">
    <div id="comments" class="comments-area twelve columns">

        <h3 class="comments-title">

            {{ $post->comment_published_count }} {{ trans_choice('comment|comments', $post->comment_published_count) }}
            on the topic {{ $post->title }}

            <div id="respond" class="comment-respond">
                <h3 id="reply-title" class="comment-reply-title">Add comment</h3>
                <form action="" method="post" id="commentform" class="comment-form">
                    <p class="comment-notes">
                        <span id="email-notes">Your e-mail will not be published.</span>
                    </p>
                    <p class="comment-form-comment">
                        <textarea id="comment" name="comment" required cols="45" rows="8"
                                  placeholder="Write a message..." aria-required="true"></textarea>
                    </p>
                    <p class="comment-form-author">
                        <input x-autocompletetype="name-full" id="author" name="author" type="text" required size="30"
                               placeholder="Your name" aria-required="true"/>
                    </p>
                    <p class="comment-form-email">
                        <input x-autocompletetype="email" id="email" name="email" type="text" required size="30"
                               placeholder="Your email" aria-required="true"/>
                    </p>
                    <p class="form-submit">
                        <input name="submit" type="submit" id="submit" class="submit" value="Send comment"/>
                        <input type='hidden' name='comment_post_ID' value='1' id='comment_post_ID'/>
                        <input type='hidden' name='comment_parent' id='comment_parent' value='0'/>
                    </p>
                </form>
            </div>

    </div>
</div>



