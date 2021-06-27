@extends('layout')

@section('content')
<div class="group_container wait">
<h2>Please Wait a Moment</h2>
<p>＊管理者からグループの参加が許可されるまでお待ちください…</p>
<a class="group_cancel" value="{{ $user_group->id }}"style="text-decoration:underline;color:purple">＊このグループの参加をキャンセルする＊</a>
</div>
@endsection