@extends('layout')

@section('styles')
    @include('share.flatpickr.styles')
    <!-- <link rel="stylesheet" href="{{ asset('styles/bg.css')}}"> -->
@endsection

@section('content')
<div class="task_container delete">
<h2>Delete Task</h2>           
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $message)
        <p>{{ $message }}</p>
        @endforeach
    </div>
    @endif
    <p class="delete_confirm">以下のタスクを削除しますか？</p>
    <form method="post" action="{{ route('group_tasks.delete', ['id' => $group_id, 'folder_id' => $folder_id, 'task_id' => $task->id]) }}">
    @csrf
    <table>
        <tr class="task_input_group">
            <th><p>タイトル</p></th>
            <td><p>{{$task->title}}</p></td>
        </tr>
        <tr class="task_input_group">
            @if($task->status == 0)
            <th><p>状態</p></th>
            <td><p>未着手</p></td>
            @endif
            @if($task->status == 1)
            <th><p>状態</p></th>
            <td><p>着手中</p></td>
            @endif
            @if($task->status == 2)
            <th><p>状態</p></th>
            <td><p>完了</p></td>
            @endif
        </tr>       
        <tr class="task_input_group">
            <th><p>期限</p></th>
            <td><p>{{$task->due_date}}</p></td>
        </tr>
    </table>
    <div class="task_input_btn">
        <button type="submit" class="btn">削除</button>
    </div>
    </form>
</div>
@endsection


