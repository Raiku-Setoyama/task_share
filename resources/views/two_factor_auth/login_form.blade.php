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
<link rel="stylesheet" href="{{ asset('css/app.css')}}">
<link rel="stylesheet" href="/styles/header.css">
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> -->
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
        <div id="app" class="p-5">
        <div class="alert alert-info" v-if="message" v-text="message"></div>

        <!-- １段階目のログインフォーム -->
            <div v-if="step==1">
                <div class="form-group">
                    <label>メールアドレス</label>
                    <input type="text" class="form-control" v-model="email">
                </div>
                <div class="form-group">
                    <label>パスワード</label>
                    <input type="password" class="form-control" v-model="password">
                </div>
                <button type="button" class="btn btn-primary" @click="firstAuth">送信する</button>
                @if (Route::has('password.request'))
                    <a class="btn-link" href="{{ route('password.request') }}" style="margin-top:20px ; display:block">
                        {{ __('パスワードをお忘れの場合はこちら') }}
                    </a>
                @endif
            </div>

            <!-- ２段階目・ログインフォーム -->
            <div v-if="step==2">
                ２段階認証のパスワードをメールアドレスに登録しました。（有効時間：10分間）
                <hr>
                <div class="form-group">
                    <label>２段階パスワード</label>
                    <input type="text" class="form-control" v-model="token">
                </div>
                <button type="button" class="btn btn-primary" @click="secondAuth">送信する</button>
            </div>
        </div>
    </main>
    <p class="copy_right">@Raiku</p>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                step: 1,
                email: '',
                password: '',
                token: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }, 
                userId: -1,
                message: ''
            },
            methods: {
                firstAuth() {

                    this.message = '';

                    const url = '/ajax/two_factor_auth/first_auth';
                    const params = {
                        email: this.email,
                        password: this.password,
                    };
                    axios.post(url, params)
                        .then(response => {

                            const result = response.data.result;

                            if(result) {
                                    this.userId = response.data.user_id;
                                    this.step = 2;
                            }else{
                                this.message = 'ログイン情報が間違っています。';
                            }
                        });
                },
                secondAuth() {
                    const url = '/ajax/two_factor_auth/second_auth';
                    const params = {
                        user_id: this.userId,
                        tfa_token: this.token
                    };

                    axios.post(url, params)
                        .then(response => {

                            const result = response.data.result;

                            if(result) {

                                // ２段階認証成功
                                location.href = '/';

                            } else {

                                this.message = '２段階パスワードが正しくありません。';
                                this.token = '';

                            }

                        });

                }
            }
        });

    </script>
</body>
</html>
