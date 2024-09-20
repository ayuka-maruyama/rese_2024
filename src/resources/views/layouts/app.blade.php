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
    <!-- header部分の共通レイアウト -->
    <header class="header">
        <div class="navbar">
            <button class="menu-button" type="button">
                <span class="menu-line line1"></span>
                <span class="menu-line line2"></span>
                <span class="menu-line line3"></span>
            </button>
            <div class="menu">
                <!-- ログインしていない場合のメニュー -->
                @guest
                <a href="{{ route('home') }}" class="menu__item">Home</a>
                <a href="{{ route('register') }}" class="menu__item">Registration</a>
                <a href="{{ route('login') }}" class="menu__item">Login</a>
                @endguest

                <!-- ログインしている場合のメニュー -->
                @auth
                <a href="{{ route('home') }}" class="menu__item">Home</a>
                <form action="{{ route('logout') }}" method="post" class="menu__item">
                    @csrf
                    <button class="menu__item-button" type="submit">Logout</button>
                </form>
                <!-- <a href="{{ route('logout') }}" class="menu__item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a> -->
                <a href="{{ route('mypage') }}" class="menu__item">Mypage</a>

                <!-- ログアウト用フォーム -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form> @endauth
            </div>
            <h1 class="logo">Rese</h1>
            @yield('header')
        </div>
    </header>

    <!-- main部分の共通レイアウト差し込み -->
    <main class="main">
        @yield('content')
    </main>

    <!-- JavaScript読み込み部分 -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>

</html>