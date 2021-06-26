@extends('layout')

@section('styles')
    @include('share.flatpickr.styles')
@endsection

@section('content')
<div class="task_container add">
    <div class="task_att add">
        <p>Add Task</p>
    </div>
    <div class="task_message">Add</div>
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
            <form action="{{route('tasks.add',['id' => $current_group_id , 'folder_id' => $current_folder_id,'task_id' => $copy_task->id]) }}" method="POST">
            @csrf
            <div class="task_input_group">
                <label for="title">タイトル</label><br>
                <input type="text" class="input" name="title" id="title" value="{{ $copy_task->title }}"/>
            </div>
            <div class="task_input_group">
                <label for="due_date">期限</label><br>
                <input type="text" class="input" name="due_date" id="due_date" value="{{ $copy_task->due_date }}" />
            </div>
            <div class="task_input_group">
            <label for="selected_folder">保存先フォルダ</label><br>
                <select name="selected_folder" id="selected_folder"> 
                <option value='' disabled selected style='display:none;'>選択してください</option>
                @foreach($folders as $folder)
                <option value="{{$folder -> id}}">
                {{$folder->title}}
                </option>
                @endforeach
                </select>
            </div>
            </div>
        </div>
    </div>
<div class="task_input_btn">
    <button type="submit" class="btn ">追加</button>
</div>
</form>
@endsection

@section('scripts')
    @include('share.flatpickr.scripts')
@endsection



