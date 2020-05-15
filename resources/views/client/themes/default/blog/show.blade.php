<?php
/**
 * @var $post App\Common\Blog\Models\Post
 */
?>

@extends('client.themes.default.layout.app')
@section('content')
    <article class="format-standard hentry">

        <div class="wide form">

            <header class="entry-header">
                <h1 class="entry-title">{{ $post->title }}</h1>
            </header>
            <div class="entry-content">
                {!!  $post->content !!}
            </div>

            <footer class="entry-meta">

            {{ \App\Helpers\Date::getFormatted($post->published_at, 'Y-m-d') }}&nbsp;

                @if($post->categories->isNotEmpty())
                    Categories:&nbsp;
                    @foreach($post->categories as $category)
                        <a href="{{ url('/') }}/category/{{ $category->slug }}">{{ $category->title }}</a>{{ $loop->last ? '' : ',' }}
                    @endforeach
                @endif

                @if($post->tags->isNotEmpty())
                    Tags:&nbsp;
                    @foreach($post->tags as $tag)
                        <a href="{{ url('/') }}/tag/{{ $tag->slug }}">{{ $tag->title }}</a>{{ $loop->last ? '' : ',' }}
                    @endforeach

                @endif

            </footer>

        </div>
    </article>

    <h3 id="reply-title" class="comment-reply-title">Read also</h3>

@endsection

