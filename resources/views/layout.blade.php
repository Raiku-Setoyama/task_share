<!DOCTYPE html>
<html lang="ja">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Task Share</title>
<link rel="shortcut icon" href="/img/icon_star.png"/>
<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
<link rel="stylesheet" href="/css/styles.css">
@if(app('env') == 'heroku')
    <link href="{{ secure_asset('styles/style.css') }}" rel="stylesheet">
@else
    <link href="{{ asset('styles/style.css') }}" rel="stylesheet">
@endif
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
@yield('styles')
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <div class="body">
        @yield('back-container')
        <div class="container">
            <header class="header">
                <nav class="navbar">
                    <a class="my-navbar-brand" href="/">Task Share
                    <span class="app_icon">
                        <img src="/img/icon_star.png" alt="icon">
                    </span>
                    </a>                
                    @if(Auth::check())
                    <div class="nav-btn-group">
                        <a href="{{ route('group.home') }}" class="btn nav-btn">
                            グループ
                        </a>
                        <a href="/" class="btn nav-btn">
                        個人
                    </a>
                    <a href="#" id="logout" class=" btn nav-btn">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                @else
                <div class="nav-btn-group">
                    <a class=" btn nav-btn" href="{{ route('login') }}">ログイン</a>
                    <a class=" btn nav-btn" href="{{ route('register') }}">会員登録</a>
                </div>
                @endif
            </nav>
        </header>
        
        <main>
            @yield('content')
        </main>
        <p class="copy_right">@Raiku</p>
    </div>
    </div>
@if(Auth::check())
<script>
    document.getElementById('logout').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('logout-form').submit();
    });
</script>
@if(app('env') == 'heroku')
    <script src="{{ secure_asset('/js/main.js') }}"></script>
@else
    <script src="{{ asset('/js/main.js') }}"></script>
@endif
@endif
@yield('scripts')
</body>
</html>