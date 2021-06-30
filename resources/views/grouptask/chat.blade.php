@extends('layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('styles/bg-chat.css')}}">
@endsection


@section('content')
<div class="people_img">
<img src="/img/chat_people01.jpg" alt="">
</div>
<div value="{{ $task->id }}" id="chat" class="chat">
    <div class="basic_menu task_memos">
        <div class="basic_menu_container">
            <p class="menu_title">{{ $task->title }}</p>
            <div class="menu_item">
                <div class="menu_item_top">
                    <p class="menu_item_title">メモを追加<span class="menu_item_title_btn">+</span></p>
                </div>
                <div class="menu_item_tab memo_input">
                <form method="POST" class="create_memos" action="{{ route('chat.memo', [ 'id' =>$id, 'folder_id' =>$folder_id, 'task_id' => $task_id]) }}">
                    @csrf
                    <input class="menu_item_tab_input" type="text" name="title" placeholder="(*必須)タイトル">
                    <textarea class="menu_item_tab_memo" name="memo" placeholder="メモ内容"></textarea>
                    <button type="submit" class="memo_add">追加</button>
                </form>
                </div>
            </div>
            <div class="menu_item">
                <p class="menu_item_title">メモ一覧</p>
                @if($task_memos)
                @foreach($task_memos as $memo)
                <div class="menu_item_tab">
                    <p class="menu_item_tab_title">{{ $memo->title}}<span class="menu_item_tab_open_btn">></span></p>
                    <div class="menu_item_tab_open memo_content">
                        <div class="menu_item_tab_open_data">
                            <span class="memos_user">{{ $user->name}}</span>
                            <span class="memos_date">{{ $memo->created_at}}</span>
                        </div>
                        <div class="menu_item_tab_open_content">
                            <p>{{ $memo->memo}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="chat_wrap">
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
</div>

@endsection

@section('scripts')
<script src="{{ asset('/js/comment.js') }}"></script>
@endsection

