
@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/bg-chat.css')}}">
@endsection


@section('content')

<div value="{{ $task->id }}" id="chat" class="chat">
    <div class="group_task_list">
        <div class="group_task_item">
            
        </div>
    </div>
    <div class="chat_task_title">{{ $task->title }}</div>
    <div class="chat_container" id="chat_container">
        <div class="chat_view" id="chat_view"></div>
    </div>
    <div class="chat_input">
    <form method="POST" class="create_message" action="{{route('chat.add', [ 'id' =>$id, 'folder_id' =>$folder_id, 'task_id' => $task_id])}}">
            @csrf
            <textarea class="chat_input_message" id="comment" rows="3" col ="30" name="comment"></textarea>
            <button type="submit" class="btn chat_input_btn">Submit</button>
    </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('/js/comment.js') }}"></script>
@endsection

