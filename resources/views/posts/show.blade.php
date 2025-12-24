@extends('layouts.app')

@section('content')
    <div class="content-card">
        <div style="border-bottom: 1px solid var(--color-border); padding-bottom: 15px; margin-bottom: 20px;">
            <small style="color: var(--color-text-secondary); text-transform: uppercase; font-size: 0.8rem;">
                {{ $post->category->name ?? 'Без категории' }} • {{ $post->created_at->format('d.m.Y H:i') }}
            </small>
            <h1 style="margin-top: 5px; color: var(--color-text-primary);">{{ $post->title }}</h1>
            
            @if($post->tags->count())
                <div style="margin-top: 10px;">
                    @foreach($post->tags as $tag)
                        <span class="tag">#{{ $tag->name }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        <div style="font-size: 1.1rem; line-height: 1.6; margin-bottom: 40px; color: var(--color-text-primary);">
            {{ $post->content }}
        </div>

        <hr style="border: 0; border-top: 1px solid var(--color-border);">

        <div style="margin-top: 30px; margin-bottom: 30px;">
            <h3 style="margin-bottom: 15px;">Оставить комментарий</h3>
            <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea class="form-input" name="body" rows="3" placeholder="Напишите, что вы думаете..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: auto; padding: 10px 20px;">Отправить</button>
            </form>
        </div>

        <h3 style="margin-top: 30px;">Комментарии ({{ $post->comments->count() }})</h3>
        
        @if($post->comments->isNotEmpty())
            <ul style="list-style: none; padding: 0; margin-top: 20px;">
                @foreach($post->comments as $comment)
                    <li style="background: rgba(255,255,255,0.03); padding: 15px; margin-bottom: 10px; border-radius: 8px; border: 1px solid var(--color-border);">
                        <p style="margin: 0; color: var(--color-text-primary);">{{ $comment->body }}</p>
                        <small style="color: var(--color-text-secondary); display: block; margin-top: 5px;">{{ $comment->created_at->diffForHumans() }}</small>
                    </li>
                @endforeach
            </ul>
        @else
            <p style="color: var(--color-text-secondary); font-style: italic;">Комментариев пока нет. Будьте первым!</p>
        @endif

        <div style="margin-top: 30px;">
            <a href="{{ route('posts.index') }}" class="btn btn-primary" style="background-color: transparent; border: 1px solid var(--color-border); color: var(--color-text-primary);">← Назад к списку</a>
        </div>
    </div>
@endsection