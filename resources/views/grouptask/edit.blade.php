@extends('layout')

@section('styles')
    @include('share.flatpickr.styles')
    <!-- <link rel="stylesheet" href="{{ asset('styles/bg.css')}}"> -->
@endsection

@section('content')
<div class="task_container edit">
<h2>Edit Task</h2>           
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $message)
        <p>{{ $message }}</p>
        @endforeach
    </div>
    @endif
    <form action="{{ route('group_tasks.edit', ['id' => $group_id, 'folder_id' => $folder_id , 'task_id' => $task->id]) }}" method="POST">
    @csrf
    <table>
        <tr class="task_input_group">
            <th><p>タイトル</p></th>
            <td><input class="textbox" type="text" class="form-control" name="title" id="title" value="{{ old('title') ?? $task->title }}"></td>
        </tr>
        <tr class="task_input_group">
            <th><p>状態</p></th>
            <td>               
                <select class="textbox" name="status" id="status" class="form-control">
                @foreach(\App\Task::STATUS as $key => $val)
                    <option
                        value="{{$key}}" 
                        {{$key == old($task->status) ? selected : ''}}
                    >
                    {{$val['label']}}
                    </option>
                @endforeach
                </select>
            </td>
        </tr>
        <tr class="task_input_group">
            <th><p>期限</p></th>
            <td><input class="textbox" type="text" class="input" name="due_date" id="due_date" value="{{ old('due_date') ?? $task->formatted_due_date }}"/></td>
        </tr>
    </table>
    <div class="task_input_btn">
        <button type="submit" class="btn">変更</button>
    </div>
    </form>
</div>
@endsection

@section('scripts')
    @include('share.flatpickr.scripts')
@endsection


