

@extends('layout')

@section('content')
<div class="folder_container delete">
<h2>Delete This Folder,OK?</h2>     
<p class="delete_alert">＊フォルダを削除するとフォルダ内のタスクもすべて削除されます</p>
    <form method="post" action="{{ route('folders.delete',['id' => $folder->id]) }}">
    @csrf
        <p class="folder_item">
            フォルダ名：{{$folder->title}}
        </p>
    <div class="task_input_btn">
        <button type="submit" class="btn">削除</button>
    </div>
    </form>
</div>
@endsection