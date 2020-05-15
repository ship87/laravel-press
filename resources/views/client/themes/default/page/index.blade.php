<div class="breadcrumbs"><a href="{{ url('/') }}">Главная</a> → {{  $model->cs }}</div>
<br>

<article class="format-standard hentry">

    <div class="wide form">

        <header class="entry-header">
            <h1 class="entry-title">{{ $model->post_title }}</h1>
        </header>
        <div class="entry-content">
            {{ $model->post_content }}
        </div>

    </div>

</article>

<?php if ($model->comment_status == 'open') { ?>

<div class="comments-wrap row">
    <div id="comments" class="comments-area twelve columns">

        <h3 class="comments-title">{{$model->comment_count.' комментариев на тему "'.$model->post_title.'"' }}</h3>

        {{ $this->renderPartial('_comments',array('comments'=>$model->comments)) }}


        <div id="respond" class="comment-respond">
            <h3 id="reply-title" class="comment-reply-title">Добавить комментарий</h3>
            <form action="" method="post" id="commentform" class="comment-form">
                <p class="comment-notes"><span id="email-notes">Ваш e-mail не будет опубликован.</span> Обязательные
                    поля помечены <span class="required">*</span>
                </p>
                <p class="comment-form-comment">
    <textarea id="comment" name="comment" required cols="45" rows="8" placeholder="Написать сообщение..."
              aria-required="true">
    </textarea>
                </p>
                <p class="comment-form-author">
                    <input x-autocompletetype="name-full" id="author" name="author" type="text" required size="30"
                           placeholder="Ваше имя: *" aria-required="true"/>
                </p>
                <p class="comment-form-email">
                    <input x-autocompletetype="email" id="email" name="email" type="text" required size="30"
                           placeholder="Ваш почтовый ящик: *" aria-required="true"/>
                </p>
                <p class="form-submit">
                    <input name="submit" type="submit" id="submit" class="submit" value="Отправить комментарий"/>
                    <input type='hidden' name='comment_post_ID' value='{{ $model->ID }}' id='comment_post_ID'/>
                    <input type='hidden' name='comment_parent' id='comment_parent' value='0'/>
                </p>
                <p style="display: none;"><input type="hidden" id="akismet_comment_nonce" name="akismet_comment_nonce"
                                                 value="f7e5a31ec9"/></p>
                <p style="display: none;"><input type="hidden" id="ak_js" name="ak_js" value="34"/></p>
            </form>
        </div>
    </div>
</div>

<?php }  ?>
