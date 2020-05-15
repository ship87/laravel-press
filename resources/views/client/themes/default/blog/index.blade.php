@extends('client.themes.default.layout.app')
@section('content')

    @forelse($posts as $post)
        @include('client.themes.default.blog.partials.post-preview', [
            'post' => $post
        ])
    @empty
    @endforelse

    {{ $posts->links('client.themes.default.blog.partials.pagination') }}

@endsection
