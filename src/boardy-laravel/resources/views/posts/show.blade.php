@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article class="post-card">
        <div class="post-header">
            <span class="post-author">{{ $post->author->name }}</span>
            <span class="post-time">{{ $post->created_at->format('d.m.Y H:i') }}</span>
        </div>

        <h1 class="page-title">{{ $post->title }}</h1>
        <p class="post-body">{{ $post->body }}</p>

        {{-- Кнопки редактирования и удаления (видимы только автору поста) --}}
        <div style="margin-top: 20px; display: flex; gap: 10px;">
            @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-secondary">Редактировать</a>
            @endcan

            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Удалить пост?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            @endcan
        </div>
    </article>

    {{-- Блок комментариев --}}
    <section class="comments-section">
        <h3>Комментарии ({{ $post->comments->count() }})</h3>

        {{-- Форма добавления нового комментария --}}
        @auth
            <form action="{{ route('comments.store', $post) }}" method="POST" class="auth-card" style="margin: 20px 0; max-width: 100%;">
                @csrf
                <div class="form-group">
                    <label for="body">Оставить комментарий:</label>
                    <textarea name="body" id="body" class="form-control" required placeholder="Напишите ваш комментарий..."></textarea>
                    @error('body')
                    <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        @else
            <p style="margin: 15px 0;">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}">Войдите</a>, чтобы оставить комментарий.
                @else
                    Войдите, чтобы оставить комментарий.
                @endif
            </p>
        @endauth

        {{-- Список всех комментариев --}}
        @forelse ($post->comments as $comment)
            <div class="comment-card">
                <div class="post-header">
                    <strong>{{ $comment->author->name }}</strong>
                    <span class="post-time">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                </div>
                <p>{{ $comment->body }}</p>
            </div>
        @empty
            <p style="color: #777;">Комментариев пока нет.</p>
        @endforelse
    </section>
@endsection
