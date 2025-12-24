@extends('layouts.app')

@section('content')
    <div class="content-card">
        <h2>Полученные данные (Feedback)</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Сообщение</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($feedbackItems as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->message }}</td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                                <a href="{{ route('feedback.edit', $item) }}" class="btn btn-primary" style="padding: 5px 10px; font-size: 12px;">Edit</a>
                                <form action="{{ route('feedback.destroy', $item) }}" method="POST" onsubmit="return confirm('Удалить?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px; background-color: #e3342f; border: none; color: white;">Del</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">Данных пока нет.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $feedbackItems->links() }}
        </div>
    </div>
@endsection