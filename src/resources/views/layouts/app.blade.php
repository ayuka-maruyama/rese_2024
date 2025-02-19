<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/destyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    <title>Rese</title>
</head>

<body data-is-logged-in="{{ Auth::check() ? 'true' : 'false' }}">
    <header class="header">

        <div class="navbar">
            <button class="menu-button" type="button">
                <span class="menu-line line1"></span>
                <span class="menu-line line2"></span>
                <span class="menu-line line3"></span>
            </button>
            <div class="menu">
                @guest
                <a href="{{ route('home') }}" class="menu__item">Home</a>
                <a href="{{ route('register') }}" class="menu__item">Registration</a>
                <a href="{{ route('login') }}" class="menu__item">Login</a>
                @endguest

                @auth
                <a href="{{ route('home') }}" class="menu__item">Home</a>
                <form action="{{ route('logout') }}" method="post" class="menu__item">
                    @csrf
                    <button class="menu__item-button" type="submit">Logout</button>
                </form>
                <a href="{{ route('mypage') }}" class="menu__item">Mypage</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endauth
            </div>
            <h1 class="logo">Rese</h1>
            @yield('header')
        </div>
    </header>

    <main class="main">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class=" alert alert-error" id="error-message">
            {{ session('error') }}
        </div>
        @endif

        @if (session('message'))
        <div class="alert alert-message">
            {{ session('message') }}
        </div>
        @endif

        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>

</html>