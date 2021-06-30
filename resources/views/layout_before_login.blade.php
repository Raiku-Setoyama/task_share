<!DOCTYPE html>
<html lang="ja">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Task Share</title>
<link rel="shortcut icon" href="/img/icon_star.png"/>
<link rel="stylesheet" href="{{ mix('css/app.css')}}">
<link rel="stylesheet" href="/styles/header.css">
@yield('styles')
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <a class="my-navbar-brand" href="/">Task Share
            <span class="app_icon">
                <img src="/img/icon_star.png" alt="icon">
            </span>
            </a>                
            <div class="nav-btn-group">
                <a class=" btn nav-btn" href="{{ route('two_factor_auth') }}">ログイン</a>
                <a class=" btn nav-btn" href="{{ route('register') }}">会員登録</a>
            </div>
        </nav>
    </header>
    <main>
@yield('content')
    </main>
    <p class="copy_right">@Raiku</p>
@yield('scripts')
</body>
</html>
