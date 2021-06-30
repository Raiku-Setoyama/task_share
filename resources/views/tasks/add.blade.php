@extends('layout')

@section('styles')
    @include('share.flatpickr.styles')
@endsection


@section('content')
<div class="task_container add">
<h2>Add Task</h2>           
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $message)
        <p>{{ $message }}</p>
        @endforeach
    </div>
    @endif
    <form action="{{route('tasks.add',['id' => $current_group_id , 'folder_id' => $current_folder_id,'task_id' => $copy_task->id]) }}" method="POST">
    @csrf
    <table>
        <tr class="task_input_group">
            <th><p>タイトル</p></th>
            <td><input class="textbox" type="text" class="input" name="title" id="title" value="{{ $copy_task->title }}"></td>
        </tr>
        <tr class="task_input_group">
            <th><p>期限</p></th>
            <td><input class="textbox"t type="text" class="input" name="due_date" id="due_date" value="{{ $copy_task->due_date }}" /></td>
        </tr>
        <tr class="task_input_group">
            <th><p>保存フォルダ</p></th>
            <td>
                <select class="textbox" name="selected_folder" id="selected_folder"> 
                    <option value='' disabled selected style='display:none;'>選択してください</option>
                    @foreach($folders as $folder)
                    <option value="{{$folder -> id}}">
                    {{$folder->title}}
                    </option>
                    @endforeach
                </select>
            </td>
        </tr>
    </table>
    <div class="task_input_btn">
        <button type="submit" class="btn">追加</button>
    </div>
    </form>
</div>
@endsection

@section('scripts')
@include('share.flatpickr.scripts')
@endsection





