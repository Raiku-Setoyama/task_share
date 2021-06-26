<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use App\User;
use App\Group;
use App\GroupTask;
use App\GroupFolder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\AddTask;
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{
    public function index(int $id)
    {
        $this->checkRelation($id);
        // タスク画面表示

        if(Auth::user()->folders()->first())
        {
            // dd(Auth::user()->id);
            // すべてのフォルダを取得する
            $folders = Auth::user()->folders()->get();
            
            // 選ばれたフォルダを取得する
            $current_folder = Folder::find($id); 
            $current_folder_id = $id;
            // 選ばれたフォルダに紐づくタスクを取得する
            $complete_tasks = DB::table('tasks')->where('deleted_at','=',null)->where('folder_id', '=', $id)->where('status', '=', 3)->orderBy('updated_at','desc')->get();
            $doing_tasks = DB::table('tasks')->where('deleted_at','=',null)->where('folder_id', '=', $id)->where('status', '<', 3)->get();    
            
            return view('tasks/index', compact(
                'folders',
                'current_folder_id',
                'complete_tasks',
                'doing_tasks',
            ));

        }else{
            return redirect()->route('home');
        }
    }

    public function showCreateForm(int $id)
    {
        $this->checkRelation($id);

        // タスク作成画面表示

        $folder_id=$id;

        return view('tasks/create',compact(
            'folder_id',
        ));
    }

    public function create(int $id, CreateTask $request)
    {
        $this->checkRelation($id);

        // タスクをフォルダに紐づけてDBに保存・作成
        $task = new Task;
        $task->title=$request->title;
        $task->due_date=$request->due_date;
        
        $current_folder=Folder::find($id);
        // dd(Task::get());
        $current_folder->tasks()->save($task);
        
        return redirect()->route('tasks.index',[
            'id' => $current_folder->id,
        ]);
    }

    public function showEditForm(int $id, int $task_id)
    {
        $this->checkRelation($id);

        // タスク編集画面表示
        $task = Task::find($task_id);

        return view('tasks/edit',compact(
            'task',
        ));
    }

    public function edit(int $id, int $task_id, EditTask $request)
    {
        $this->checkRelation($id);

        // タスク編集内容をDBに保存
        $task = Task::find($task_id);
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // タスクが完了(status=3)したら、紐づけていたグループのタスクも完了に設定する
        if($request->status == 3 && isset($task->group_task_id))
        {
            $complete_group_task=GroupTask::find($task->group_task_id);
            $complete_group_task->status=3;
            $complete_group_task->save();
        };

        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
    ]);

}

    public function showDeleteForm(int $id, int $task_id)
    {
        $this->checkRelation($id);

        // タスク削除画面表示
        $task=Task::find($task_id);

        return view('tasks/delete',compact(
            'task',
        ));
    }

    public function delete(int $id, int $task_id)
    {
        $this->checkRelation($id);

        // タスク削除
        Task::find($task_id)->delete();

        $folder_id=$id;

        return redirect()->route('tasks.index',[
            'id' => $folder_id,
        ]);
    }

    public function showAddForm(int $id, int $folder_id, int $task_id)
    {
        $this->checkRelation($id);

        //グループタスクを個人タスクへ追加する画面表示   

        // コピーするタスクの情報
        $copy_task=GroupTask::find($task_id);

        // 保存先フォルダ
        $user_id=Auth::user()->id;
        $folders=User::find($user_id)->folders()->get();

        $current_group_id=$id;
        $current_folder_id=$folder_id;

        return view('tasks/add',compact(
            'copy_task',
            'folders',
            'current_group_id',
            'current_folder_id'));
    }

    public function add(int $id, int $folder_id, int $task_id, AddTask $request)
    {
        $this->checkRelation($id);

        //グループタスクを個人タスクへ追加
        // フォルダに紐づけてDBに保存

        $task= new Task;
        $task->title=$request->title;
        $task->due_date=$request->due_date;
        $task->group_task_id= $task_id;
        $selected_folder_id = $request->selected_folder;
        Folder::find($selected_folder_id)->tasks()->save($task);

        // 担当者(タスクを個人に追加したユーザー)をグループタスクに記入
        // グループタスクのuser_idにuserのidを保存

        $user_id=Auth::user()->id;
        $group_task=GroupTask::find($task_id);
        $group_task->user_id=$user_id;
        
        $user_name=User::find($user_id)->name;
        $group_task->working_user_name=$user_name;

        GroupFolder::find($folder_id)->group_tasks()->save($group_task);

        // routeに送るため
        $group_id=$id;
        $folder_id=$folder_id;

        return redirect()->route('groups.index',[
            'id' => $group_id,
            'folder_id' => $folder_id,
        ]);

    }

    public function fixed(Request $request)
    {
        // タスクが一覧画面でドラッグ移動された際の位置取得
        // jsonによってドラッグ移動ごとに情報取得

        $task = Task::find($request->id);
        $task->top_position = $request->perY;
        $task->left_position = $request->perX;
        $task->save();

        $res= '成功';
        return $res;
    }

    // 意図しないURLアクセス対策
    private function checkRelation(int $id)
    {
        if(Auth::user()->id != Folder::find($id)->user_id)
        {
            abort(404);
        }
    }
}

