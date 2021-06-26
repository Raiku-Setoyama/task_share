@extends('layout')

@section('content')
<div class="container">
    <div class="row">
    <div class="col col-md-3">
        <nav class="panel panel-default">
        <div class="panel-heading">グループ</div>
        <div class="panel-body">
            <a href="#" class="btn btn-default btn-block">
            グループを追加する
            </a>
        </div>
        
        <div class="list-group">
            @foreach($groups as $group)
            <a
                href="{{route('groups.index',['id' => $group->id, 'folder_id' => 1 ]) }}"
                class="list-group-item {{ $current_group_id == $group->id ? 'active' : '' }} "
            >
                {{ $group->name }}
            </a>
            @endforeach
        </div>
        </nav>
    </div>
    <div class="col col-md-3">
        <nav class="panel panel-default">
        <div class="panel-heading">フォルダ</div>
        <div class="panel-body">
            <a href="#" class="btn btn-default btn-block">
            フォルダを追加する
            </a>
        </div>
        <div class="list-group">
            @foreach($group_folders as $group_folder)
            <a
                href="{{ route('groups.index',['id' => $current_group->id , 'folder_id' => $group_folder->id]) }}"
                class="list-group-item "
            >
            {{$group_folder->title}}
            </a>
            @endforeach
        </div>
        </nav>
    </div>
    <div class="column col-md-3">
        <div class="panel panel-default">
        <div class="panel-heading">タスク</div>
        <div class="panel-body">
            <div class="text-right">
            <a href="#" class="btn btn-default btn-block">
                タスクを追加する
            </a>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
            <th>タイトル</th>
            <th>状態</th>
            <th>期限</th>
            <th></th>
            </tr>
            </thead>
            <tbody>
            
            <tr>
                <td></td>
                <td>
                <span class="label "></span>
                </td>
                <td></td>
                <td>
                <a href="#">
                編集
                </a>                
                </td>
            </tr>
            
            </tbody>
        </table>
        </div>
    </div>

    <div class="col col-md-3">
        <nav class="panel panel-default">
        <div class="panel-heading">個人</div>
        <div class="panel-body">
            <a href="{{route('tasks.index',['id' => $folder_id])}}" class="btn btn-default btn-block">
            個人タスクへ戻る
            </a>
    </div>
</div>
</div>

@endsection
