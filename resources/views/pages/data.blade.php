@extends('layouts.app')

@section('content')
    <div class="content-card">
        <h2>Полученные данные</h2>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Сообщение</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($feedbackItems as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['email'] }}</td>
                        <td>{{ $item['message'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center;">Данных пока нет.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection