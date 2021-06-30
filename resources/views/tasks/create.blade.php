@extends('layout')

@section('styles')
    @include('share.flatpickr.styles')
    <!-- <link rel="stylesheet" href="{{ asset('styles/bg.css')}}"> -->
@endsection

@section('content')

<div class="task_container create">
<h2>Create Task</h2>           
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $message)
        <p>{{ $message }}</p>
        @endforeach
    </div>
    @endif
    <form action="{{ route('tasks.create', ['id' => $folder_id]) }}" method="POST">
    @csrf
    <table>
        <tr class="task_input_group">
            <th><p>タイトル</p></th>
            <td><input class="textbox" type="text" class="form-control" name="title" id="title" value="{{ old('title') }}"></td>
        </tr>
        <tr class="task_input_group">
            <th><p>期限</p></th>
            <td><input class="textbox" type="text" class="input" name="due_date" id="due_date" value="{{ old('due_date') }}"></td>
        </tr>
    </table>
    <div class="task_input_btn">
        <button type="submit" class="btn">作成</button>
    </div>
    </form>
</div>
@endsection

@section('scripts')
    @include('share.flatpickr.scripts')
@endsection

