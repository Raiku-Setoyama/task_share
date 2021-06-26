@extends('layout')

@section('content')

<div class="group_container">
<h2>Create Group or Enter Group</h2>
    <div class="group_wrapper">
        <div class="group_create">
            <p class="group_mes"> Create Group!</p>
            <a href="{{ route('groups.create') }}" class="btn group_create">
                Create
            </a>
        </div>
        <div class="group_search">
            <div class="group_search_box">
                <p class="group_mes">Search Group!</p>
                <form action="{{ route('groups.search') }}" method='get'>
                @csrf
                <input class="textbox" name="search" id="search" type="search" placeholder="Input Password" aria-label="Search">
                <div class="group_search_result">
            @if($results)
                <p
                    href="#"
                    class="group_search_result_name"
                >
                {{$results->name}}
                </p>
                <a
                    href="{{ route('group.entry',['id' => $results ->id]) }}"
                    class="group_search_result_enter"
                >
                入る
                </a>
            @else
                <a
                    class="group_search_result_mes"
                >
                検索したパスワードに合致するグループはありません
                </a>
            @endif
            </div>
                <div class="task_input_btn">
                    <button type="submit" class="btn search">Search</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

