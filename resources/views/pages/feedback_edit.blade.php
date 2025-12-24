@extends('layouts.app')

@section('content')
    <div class="feedback-wrapper">
        <div class="card">
            <h2>Редактирование отзыва</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('feedback.update', $feedback) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Имя (не редактируется)</label>
                    <input type="text" class="form-input" value="{{ $feedback->name }}" disabled style="opacity: 0.7;">
                </div>

                <div class="form-group">
                    <label>Email (не редактируется)</label>
                    <input type="email" class="form-input" value="{{ $feedback->email }}" disabled style="opacity: 0.7;">
                </div>

                <div class="form-group">
                    <label for="message">Сообщение</label>
                    <textarea class="form-input" id="message" name="message" rows="5" required>{{ old('message', $feedback->message) }}</textarea>
                </div>

                <div class="form-group">
                    <label style="cursor: pointer;">
                        <input type="checkbox" name="is_reviewed" value="1" {{ old('is_reviewed', $feedback->is_reviewed) ? 'checked' : '' }}>
                        Отметить как проверенное
                    </label>
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-primary">Обновить</button>
                    <a href="{{ route('feedback.data') }}" class="btn btn-primary" style="background-color: transparent; border: 1px solid var(--color-border); color: var(--color-text-primary);">Отмена</a>
                </div>
            </form>
        </div>
    </div>
@endsection