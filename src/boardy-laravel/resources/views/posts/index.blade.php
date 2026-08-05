@extends('layouts.app')

@section('title', 'Лента постов')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 class="page-title">Лента постов</h1>
        @auth
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Создать пост</a>
        @endauth
    </div>

    <div class="posts-list">
        @forelse ($posts as $post)
            <article class="post-card">
                <div class="post-header">
                    <span class="post-author">{{ $post->author->name }}</span>
                    <span class="post-time">{{ $post->created_at->format('d.m.Y H:i') }}</span>
                </div>

                <h2 class="post-title">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                </h2>

                <p class="post-body">{{ Str::limit($post->body, 200) }}</p>
            </article>
        @empty
            <p>Постов пока нет. Будьте первым, кто создаст пост!</p>
        @endforelse
    </div>

    {{-- Ссылки пагинации --}}
    <div style="margin-top: 20px;">
        {{ $posts->links() }}
    </div>
@endsection
