@extends('layouts.app')

@section('content')
    <div class="feedback-wrapper">
        <div class="card">
            <h2>Редактирование поста</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" class="form-input" id="title" name="title" value="{{ old('title', $post->title) }}" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Категория</label>
                    <select class="form-input" id="category_id" name="category_id" style="margin-bottom: 10px;">
                        <option value="">Без категории</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" class="form-input" name="new_category" value="{{ old('new_category') }}" placeholder="Или создайте новую категорию">
                </div>

                <div class="form-group">
                    <label for="content">Текст поста</label>
                    <textarea class="form-input" id="content" name="content" rows="6" required>{{ old('content', $post->content) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Выберите теги</label>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 5px; margin-bottom: 15px;">
                        @foreach($tags as $tag)
                            <label style="cursor: pointer;">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                    {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                                {{ $tag->name }}
                            </label>
                        @endforeach
                    </div>

                    <label for="new_tags">Добавить новые (через запятую)</label>
                    <input type="text" class="form-input" id="new_tags" name="new_tags" value="{{ old('new_tags') }}" placeholder="Например: Code, Tutorial">
                </div>

                <div class="form-group">
                    <label style="cursor: pointer;">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                        Опубликован
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Обновить</button>
            </form>
        </div>
    </div>
@endsection