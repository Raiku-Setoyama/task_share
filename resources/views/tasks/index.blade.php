@extends('layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('styles/wheelmenu.css')}}">
@endsection

@section('back-container')
<div class="complete_task_list" id="complete_task_list">
    @foreach($complete_tasks as $task)
    <div class="complete_task_list_item">
        <div class="item_main">
            <p class="item_main_title">{{ $task->title}}</p>
        </div>
        <p class="complete_date">最終更新：{{ $task->updated_at}}</p>
    </div>
    @endforeach
</div>
@endsection

@section('content')
<button class="custom-btn btn-complete-task"><span>Complete</span></button>
<img src="/img/arrow-h.png" alt="" class="arrow-h">
<img src="/img/arrow-v.png" alt="" class="arrow-v">
<p class="emr">Emergency</p>
<p class="imp">Importance</p>
    <div class="wheel-button-wrap">
                <a href="#wheel" class="wheel-button drag" >
                    Folder
                </a>
            </div>
            <ul id="wheel" class="wheel">
                @foreach($folders as $folder)
                    <li
                        class="item"
                    >
                    <a href="{{ route('tasks.index', ['id' => $folder->id]) }}" class="{{ $current_folder_id === $folder->id ? 'this' : '' }}">
                        {{ $folder->title }}
                    </a>
                    </li>
                @endforeach
                <li class="item"><a href="{{ route('folders.create') }}">追加</a></li>
                @if(count($folders) >=2)
                <li class="item"><a href="{{ route('folders.delete',[ 'id' => $current_folder_id]) }}">削除</a></li>
                @endif
            </ul>
        <a href="{{route('tasks.create',['id' => $current_folder_id])}}" class="btn task-add drag">Add Task</a>
        @foreach($doing_tasks as $task)
        <div class="task drag" value="{{ $task->id }}"
            style="top:{{$task->top_position}}%; left:{{ $task->left_position}}%;">
            <div class="task_tape"></div>
            <p class="task_title">{{ $task->title }}</p>
            
            <table class="task_table">
                <thead>
                <tr>
                    <th>状態</th>
                    <th>期限</th>
                    <th></th>
                @if(isset($task->group_task_id))
                <th><span class="task_label">Group</span></th>
                @endif
            </tr>
        </thead>
                <tbody>
                <tr>
                    @if($task->status == 1)
                    <td>
                        <span class="label">未着手</span>
                    </td>
                    @elseif($task->status == 2)
                    <td>
                        <span class="label">着手中</span>
                    </td>
                    @endif
                    <td>{{ $task->due_date }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">
                            編集
                        </a>                
                    </td>
                    <td><a class="label delete" href="{{ route('tasks.delete',[ 'id' => $current_folder_id, 'task_id' => $task->id]) }}">削除</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    @endforeach
    
@endsection


@section('scripts')
<script src="{{ asset('/js/main.js') }}"></script>
<script src="{{ asset('/js/jquery.wheelmenu.js') }}"></script>
@endsection
