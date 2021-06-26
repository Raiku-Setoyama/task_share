@extends('layout')

@section('content')
<div class="folder_container create">
<h2>Create Folder</h2>           
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $message)
        <p>{{ $message }}</p>
        @endforeach
    </div>
    @endif
    <form method="post" action="{{ route('group_folders.create',[ 'id' => $current_group_id]) }}">
    @csrf
    <label for="title">フォルダ名</label>
    <input class="textbox" type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
    <div class="task_input_btn">
        <button type="submit" class="btn">作成</button>
    </div>
    </form>
</div>
@endsection