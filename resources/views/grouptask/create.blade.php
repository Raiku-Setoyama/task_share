@section('scripts')
    @include('share.flatpickr.scripts')
@endsection

@extends('layout')

@section('styles')
    @include('share.flatpickr.styles')
    <!-- <link rel="stylesheet" href="{{ asset('styles/bg.css')}}"> -->
@endsection

@section('content')
<div class="task_container create">
    <div class="task_att">
        <p>Create Task</p>
    </div>
    <div class="task_message">Create</div>
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
            <form action="{{ route('group_tasks.create', ['id' => $current_group_id, 'folder_id' => $current_folder_id]) }}" method="POST">
            @csrf
            <div class="task_input_group">
                <label for="title">タイトル</label><br>
                <input type="text" class="input" name="title" id="title" value="{{ old('title') }}" />
            </div>
            <div class="task_input_group">
                <label for="due_date">期限</label><br>
                <input type="text" class="input" name="due_date" id="due_date" value="{{ old('due_date') }}" />
            </div>
        </div>
    </div>
</div>
<div class="task_input_btn">
    <button type="submit" class="btn ">作成</button>
</div>
</form>
@endsection

@section('scripts')
    @include('share.flatpickr.scripts')
@endsection