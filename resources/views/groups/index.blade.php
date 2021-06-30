
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
            <a class="chat-btn" href="{{ route('chats.index',[ 'id' => $group->id , 'folder_id' => $current_folder_id, 'task_id' => $task->id]) }}">Chat</a>
        </div>
        @if($task->working_user_name)
        <p class="complete_user">担当者：{{ $task->working_user_name}}</p>
        @endif
        <p class="complete_date">最終更新：{{ $task->updated_at}}</p>
    </div>
    @endforeach
</div>
<div class="basic_menu group_menu">
    <div class="basic_menu_container">
        <p class="menu_title">{{ $group->name }}</p>
        @can('isAdmin')
        <div class="menu_item">
            <div class="menu_item_top">
                <p class="menu_item_title">管理者メニュー</p>
            </div>
            <div class="menu_item_tab">
                <p class="menu_item_tab_title">参加待ちユーザー<span class="wait_user_count">{{ count($wait_users) }}</span><span class="menu_item_tab_open_btn">></span></p>
                <div class="menu_item_tab_open wait_user">
                    @if(count($wait_users) != 0)
                    @foreach($wait_users as $user)
                    <li><span>{{ $user->name }}</span><a href ="{{ route('group.right', ['id' => $group->id , 'folder_id' => $current_folder_id, 'user_id' => $user->id]) }}" method='get' class="member_right">許可</a></li>
                    @endforeach
                    @else
                    <p>参加待ちユーザーはいません</p>
                    @endif
                </div>
            </div>
            <div class="menu_item_tab">
                <p class="menu_item_tab_title"><a href="#" value="{{ $group->id }}" id="group_delete">グループを削除</a></p>
            </div>
        </div>
        @endcan
        <div class="menu_item">
            <div class="menu_item_top">
                <p class="menu_item_title">メンバーメニュー</p>
            </div>
            <div class="menu_item_tab">
                <p class="menu_item_tab_title">メンバーリスト<span class="menu_item_tab_open_btn">></span></p>
                <table class="menu_item_tab_open group_member">
                    <th>メンバー名</th>
                    <th>タスク数</th>
                    @foreach($group_members as $member)
                    @if($member->group_status == 2)
                    <tr>
                        <td class="member_name">
                        {{ $member->name}}
                        </td>
                        @if($user_id_count)
                        @foreach( $user_id_count as $key => $val)
                        @if($key == $member->id)
                        <td class="member_task_count"><span>{{ $val }}</span></td>
                        @endif
                        @endforeach
                        @endif
                        </tr>
                    @endif
                    @endforeach
                </table>
            </div>
            <div class="menu_item_tab">
                <p class="menu_item_tab_title"><a href="{{ route('group.out',[ 'id' => $group->id ]) }}">グループを退会</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
    <button class="custom-btn btn-member"><span>{{ $group->name }}</span></button>
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
                    @foreach($group_folders as $group_folder)
                        <li
                            class="item"
                        >
                        <a 
                            href="{{route('groups.index',['id'=> $group->id, 'folder_id' => $group_folder->id])}}"
                            class="list-group-item {{ $current_folder_id == $group_folder->id ? 'this' : ''}}"
                        >
                        {{$group_folder->title}}
                        </a>
                        </li>
                    @endforeach
                        <li class="item"><a href="{{ route('group_folders.create', [ 'id' => $group->id]) }}">追加</a></li>
                    @if(count($group_folders) >=2)
                        <li class="item"><a href="{{ route('group_folders.delete',[ 'id' => $group->id, 'folder_id' => $current_folder_id]) }}">削除</a></li>
                    @endif
                </ul>
            <a href="{{ route('group_tasks.create',['id' => $group->id , 'folder_id' => $current_folder_id]) }}" class="btn task-add drag">Add Task</a>
            @foreach($doing_tasks as $task)
            <div class="task group-drag" value="{{ $task->id }}"
                style="top:{{$task->top_position}}%; left:{{ $task->left_position}}%;">
                <div class="task_tape"></div>
                <div class="task_title"><span class="task_title_default">{{ $task->title }}</span><input type="text" value="{{ $task->title }}" name="title" id="title" class="task_title_change" style='display:none'></div>
                <table class="task_table">
                    <thead>
                        <tr>
                            <th>状態</th>
                            <th>期限</th>
                            <th>担当者</th>
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
                        @if(! $task->user_id)
                        <td >
                        <a href="{{ route('tasks.add',['id' => $group->id , 'folder_id' => $current_folder_id, 'task_id' => $task->id ] )}}" 
                        class="task_label">
                        担当する!
                        </a>                
                        </td>
                        @else
                        <td>
                        <span class="task_label">{{$task->working_user_name}}</span>
                        </td>
                        @endif
                        <td>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="to_chat">
                    <a class="chat-btn" href="{{ route('chats.index',[ 'id' => $group->id , 'folder_id' => $current_folder_id, 'task_id' => $task->id]) }}">More</a>
                    <div class="option">
                        <a href="{{ route('group_tasks.edit', ['id' => $group->id, 'folder_id' => $current_folder_id , 'task_id' => $task->id]) }}" method="post" class="edit_change_btn">
                            編集
                        </a>         
                        <a class="label delete" href="{{ route('group_tasks.delete',[ 'id' => $group->id , 'folder_id' => $current_folder_id, 'task_id' => $task->id]) }}">削除</a>
                    </div>
                </div>
            </div>
        </form>
    @endforeach

@endsection


@section('scripts')
<script src="{{ asset('/js/jquery.wheelmenu.js') }}"></script>
@endsection
