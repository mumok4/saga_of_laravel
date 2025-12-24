@extends('layouts.app')

@section('content')
    <div class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Список постов</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-primary" style="width: auto;">Создать пост</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <table class="data-table">
            <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Категория</th>
                    <th>Теги</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name ?? 'Без категории' }}</td>
                        <td>
                            @foreach($post->tags as $tag)
                                <span class="tag">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if($post->is_published)
                                <span style="color: var(--color-success);">Опубликован</span>
                            @else
                                <span style="color: #FBBF24;">Черновик</span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary" style="padding: 5px 10px; font-size: 12px; width: auto;">View</a>
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary" style="padding: 5px 10px; font-size: 12px; width: auto; background-color: transparent; border: 1px solid var(--color-accent); color: var(--color-accent);">Edit</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Удалить пост?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px; background-color: rgba(239, 68, 68, 0.2); border: 1px solid var(--color-error); color: var(--color-error);">Del</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--color-text-secondary);">Постов нет.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div style="margin-top: 20px;">
            {{ $posts->links() }}
        </div>
    </div>
@endsection