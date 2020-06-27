<?php
/**
 * @var $post App\Common\Blog\Models\Post
 * @var $firstCategory \App\Common\Blog\Models\Category
 */

$firstCategory = $post->getFirstCategory();
?>

<article id="post" class="post type-post status-publish format-standard hentry">

    <div class="post-articles row">

        <div class="four columns">

            <a href="{{ route('client.blog.show', ['slug'=>$post->slug]) }}">

                <img src="{{ url('/') }}/themes/default/images/no-image-small.jpg"
                     alt="{{ $post->title  }}"
                     class="attachment-post-thumbnail wp-post-image">
            </a>

        </div>

        <div class="eight columns">

            <header class="entry-header">
                <h2 class="entry-title">
                    <a href="{{ route('client.blog.show', ['slug' => $post->slug]) }}"
                       title="Link to the article: {{ $post->title }}"
                       rel="bookmark"
                    >{{ $post->title }}</a>
                </h2>
            </header>

            <div class="entry-summary">
                <p>{{ \App\Helpers\Word::getPartString($post->preview_content, $sizePostPreviewContent, '...') }}</p>
            </div>

            <p class="read-more-link">
                <a href="{{ route('client.blog.show', ['slug' => $post->slug]) }}">More &rarr;</a>
            </p>

        </div>
    </div>

    <footer class="entry-meta">
        {{ \App\Helpers\Date::getFormatted($post->published_at, 'Y-m-d') }} &nbsp;
        @if($firstCategory instanceof \App\Common\Blog\Models\Category)
            <a href="{{ route('client.blog.show-category', ['slug' => $firstCategory->slug]) }}"
               rel="category tag">{{ $firstCategory->title }}</a>
            <span class="spacer"> // </span>
        @endif
        <a href="{{ route('client.blog.show', ['slug' => $post->slug]) }}">{{ $post->comment_published_count }} {{ trans_choice('comment|comments', $post->comment_published_count) }}</a>
    </footer>

</article>

<div class="post-divider"></div>