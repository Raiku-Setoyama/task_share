<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Group;
use App\GroupTask;
use App\TaskMemo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class ChatController extends Controller
{
    public function index(int $id, int $folder_id, int $task_id)
    { 
        $this->checkRelation($id);
        //タスクに紐づくチャット内容を取得
        $comments=GroupTask::find($task_id)->comments()->get();

        $task = GroupTask::find($task_id);
        $id=$id;
        $folder_id=$folder_id;
        $task_id=$task->id;
        $user = Auth::user();

        if($task->task_memos()->first())
        {
            $task_memos = $task->task_memos()->orderBy('created_at', 'desc')->get();
        }else{
            $task_memos= null;
        }

        return view('grouptask/chat',compact(
            'comments',
            'task',
            'id',
            'folder_id',
            'task_id',
            'user',
            'task_memos',
        ));
    }

    public function add(int $id, int $folder_id, int $task_id, Request $request)
    {
        $this->checkRelation($id);

        if($request->comment != '')
        {
            $user= Auth::user();
            
            // チャットのメッセージをDBに保存
            $comment = new Comment;
            $comment->name =$user->name;
            $comment->user_id =$user->id;
            $comment->comment =$request->comment;
            GroupTask::find($task_id)->comments()->save($comment);
        }

        $id=$id;
        $folder_id=$folder_id;
        $task_id=$task_id;

        return redirect()->route('chats.index',
        [
            'id' => $id,
            'folder_id' => $folder_id,
            'task_id' => $task_id,
        ]);
    }

    public function getData(Request $request)
    {
        // dd($request->group_task_id);
        $user = Auth::user();
        $comments = DB::table('comments')->where('task_id', '=', $request->group_task_id)->orderBy('created_at', 'asc')->get();
        $json = [
            "comments" => $comments,
            "user" => $user,
        ];
        return response()->json($json);
    }

    public function add_memo(int $id, int $folder_id, int $task_id, Request $request)
    {
        // タスクのメモを作成
        if($request->title)
        {
            $memos = new TaskMemo;
            $memos->title = $request->title;
            $memos->memo = $request->memo;
            $memos->user_id = Auth::user()->id;
            GroupTask::find($task_id)->task_memos()->save($memos);
        }

        return redirect()->route('chats.index',
        [
            'id' => $id,
            'folder_id' => $folder_id,
            'task_id' => $task_id,
        ]);
    }

    // 意図しないURLアクセス対策
    private function checkRelation(int $id)
    {
        if(Auth::user()->groups()->first()->id != Group::find($id)->id)
        {
            abort(404);
        }
    }
}