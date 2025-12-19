<header class="header">
    <div class="nav-container">
        <a class="logo" href="{{ route('home') }}">
            <img src="https://laravel.com/img/logomark.min.svg" alt="Logo">
            Laravel:Saga
        </a>
        <nav class="nav-menu">
            <ul>
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Главная</a></li>
                <li><a href="{{ route('feedback.form') }}" class="{{ request()->routeIs('feedback.form') ? 'active' : '' }}">Обратная связь</a></li>
                <li><a href="{{ route('feedback.data') }}" class="{{ request()->routeIs('feedback.data') ? 'active' : '' }}">Данные</a></li>
            </ul>
        </nav>
    </div>
</header>