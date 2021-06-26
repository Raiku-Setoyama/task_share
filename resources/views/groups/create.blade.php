@extends('layout')

@section('content')
<div class="group_container create">
<h2>Create Group</h2>           
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $message)
        <p>{{ $message }}</p>
        @endforeach
    </div>
    @endif
    <form method="post" action="{{ route('groups.create') }}">
    @csrf
    <div class="group_create_input">
    <label for="name">グループ名</label>
    <input class="textbox" type="text" class="form-control" name="name" id="name">
    </div>
    <div class="group_create_input">
    <label for="password">パスワード</label>
    <input class="textbox" type="text" class="form-control" name="password" id="password" value="" placeholder="半角英数字8文字以上">
    <p>＊他のメンバーがグループに入る際に使用します</p>
    </div>
    <div class="task_input_btn">
        <button type="submit" class="btn">作成</button>
    </div>
    </form>
</div>
@endsection
