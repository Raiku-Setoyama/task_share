@extends('layout')

@section('styles')
    @include('share.flatpickr.styles')
    <!-- <link rel="stylesheet" href="{{ asset('styles/bg.css')}}"> -->
@endsection

@section('content')
<div class="task_container delete">
    <div class="task_att delete">
        <p>Delete Task</p>
    </div>
    <div class="task_message">Delete</div>
    <div class="task_action">
        <div class="memo-top"></div>
        <p class="delete_confirm">以下のタスクを削除しますか？</p>
        <div class="task_input">
            <form 
                action="{{ route('tasks.delete', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" 
                method="POST">
            @csrf
            <div class="task_input_group">
            <p class="task_item">
                タイトル
            </p>
            <p>{{$task->title}}</p>
            </div>
            <div class="task_input_group">
                @if($task->status == 0)
                <p class="task_item">
                状態
                </p>
                <p>未着手</p>
                @endif
                @if($task->status == 1)
                <p class="task_item">
                状態
                </p>
                <p>着手中</p>
                @endif
                @if($task->status == 2)
                <p class="task_item">
                状態
                </p>
                <p>完了</p>
                @endif
            </div>
            <div class="task_input_group">
                <p class="task_item">
                期限日
                </p>
                <p>{{$task->due_date}}</p>
            </div>
        </div>
    </div>
</div>
<div class="task_input_btn">
    <button type="submit" class="btn ">削除</button>
</div>
</form>
@endsection