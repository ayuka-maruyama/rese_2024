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

    <header class="header">
        <div class="navbar">
            <button class="menu-button">
                <i class="fas fa-bars"></i>
                <span class="menu-line"></span>
            </button>
            <h1 class="logo">Rese</h1>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>