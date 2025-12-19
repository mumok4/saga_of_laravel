@extends('layouts.app')

@section('content')
    <div class="feedback-wrapper">
        <div class="card">
            <h2>Обратная связь</h2>
            <p class="subtitle">Ваше мнение помогает нам стать лучше.</p>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('feedback.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Ваше имя</label>
                    <input type="text" class="form-input" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-input" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="message">Сообщение</label>
                    <textarea class="form-input" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
@endsection