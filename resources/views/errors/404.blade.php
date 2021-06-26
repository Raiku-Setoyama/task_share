@extends('layout_before_login')

@section('content')
<div class="container">
    <div class="row">
    <div class="col col-md-offset-3 col-md-6" style="margin:0 auto;">
        <div class="text-center">
        <p>お探しのページは見つかりませんでした。</p>
        <a href="{{ route('home') }}" class="btn" style="margin:0 auto;">
            ホームへ戻る
        </a>
        </div>
    </div>
    </div>
</div>
@endsection