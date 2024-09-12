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

<body>
    <!-- header部分の共通レイアウト -->
    <header class="header">
        <div class="navbar">
            <button class="menu-button">
                <p class="menu-line"></p>
            </button>
            <h1 class="logo">Rese</h1>
            @yield('header')
        </div>
    </header>

    <!-- main部分の共通レイアウト差し込み -->
    <main class="main">
        @yield('content')
    </main>

    <!-- JavaScript読み込み部分 -->
    @yield('script')
</body>

</html>