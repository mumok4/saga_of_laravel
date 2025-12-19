<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel: Saga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('includes.header')

    <main class="main-container">
        @yield('content')
    </main>

    @include('includes.footer')
</body>
</html>