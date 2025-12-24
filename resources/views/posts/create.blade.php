@extends('layouts.app')

@section('content')
    <div class="feedback-wrapper">
        <div class="card">
            <h2>Новый пост</h2>
            <p class="subtitle">Создание новой записи в блоге.</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" class="form-input" id="title" name="title" value="{{ old('title') }}" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Категория</label>
                    <select class="form-input" id="category_id" name="category_id" style="margin-bottom: 10px;">
                        <option value="">Без категории</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" class="form-input" name="new_category" value="{{ old('new_category') }}" placeholder="Или создайте новую категорию">
                </div>

                <div class="form-group">
                    <label for="content">Текст поста</label>
                    <textarea class="form-input" id="content" name="content" rows="6" required>{{ old('content') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Выберите теги</label>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 5px; margin-bottom: 15px;">
                        @foreach($tags as $tag)
                            <label style="cursor: pointer;">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                {{ $tag->name }}
                            </label>
                        @endforeach
                    </div>
                    
                    <label for="new_tags">Или добавьте новые (через запятую)</label>
                    <input type="text" class="form-input" id="new_tags" name="new_tags" value="{{ old('new_tags') }}" placeholder="Например: IT, Обзоры, 2025">
                </div>

                <div class="form-group">
                    <label style="cursor: pointer;">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                        Опубликовать сразу?
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
@endsection