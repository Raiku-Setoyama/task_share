@extends('layout')

@section('styles')
    @include('share.flatpickr.styles')
    <!-- <link rel="stylesheet" href="{{ asset('styles/bg.css')}}"> -->
@endsection

@section('content')
<div class="task_container edit">
    <div class="task_att edit">
        <p>Edit Task</p>
    </div>
    <div class="task_message edit">Edit</div>
    <div class="task_action">
        <div class="memo-top"></div>
        <div class="task_input">
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                <p>{{ $message }}</p>
                @endforeach
            </div>
            @endif
            <form action="{{ route('group_tasks.edit', ['id' => $group_id, 'folder_id' => $folder_id , 'task_id' => $task->id]) }}" method="POST">
            @csrf
            <div class="task_input_group">
                <label for="title">タイトル</label><br>
                <input type="text" class="input" name="title" id="title" value="{{ old('title') ?? $task->title }}" />
            </div>
            <div class="task_input_group">
            <label for="status">状態</label><br>
                <select class="input" name="status" id="status" class="form-control">
                @foreach(\App\Task::STATUS as $key => $val)
                    <option
                        value="{{$key}}" 
                        {{$key == old($task->status) ? selected : ''}}
                    >
                    {{$val['label']}}
                    </option>
                @endforeach
                </select>
            </div>
            <div class="task_input_group">
                <label for="due_date">期限</label><br>
                <input type="text" class="input" name="due_date" id="due_date" value="{{ old('due_date') ?? $task->formatted_due_date }}" />
            </div>
        </div>
    </div>
</div>
<div class="task_input_btn">
    <button type="submit" class="btn">変更</button>
</div>
</form>
@endsection


@section('scripts')
    @include('share.flatpickr.scripts')
@endsection