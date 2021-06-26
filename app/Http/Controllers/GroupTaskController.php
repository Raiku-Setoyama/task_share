<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CreateGroupTask;
use App\Http\Requests\EditGroupTask;
use App\GroupFolder;
use App\GroupTask;


class GroupTaskController extends Controller
{
    public function showCreateForm(int $id, int $folder_id)
    {
        $this->checkRelation($id);

        // タスク作成画面表示
        $current_group_id = $id;
        $current_folder_id = $folder_id;

        return view('grouptask/create',compact('current_group_id','current_folder_id'));
    }

    public function create(int $id, int $folder_id, CreateGroupTask $request)
    {
        $this->checkRelation($id);

        // タスクを格納するフォルダに紐づけてDBに保存・作成
        $group_task = new GroupTask;
        $group_task->title = $request->title;
        $group_task->due_date = $request->due_date;
        GroupFolder::find($folder_id)->group_tasks()->save($group_task);

        $current_group_id = $id;
        $current_folder_id = $folder_id;

        return redirect()->route('groups.index', [
            'id' => $current_group_id,
            'folder_id' => $current_folder_id,
        ]);
    }

    public function showEditForm(int $id, int $folder_id, int $task_id)
    {
        $this->checkRelation($id);

        // タスク編集画面表示
        $task=GroupTask::find($task_id);
        $group_id=$id;
        $folder_id=$folder_id;

        return view('grouptask/edit',compact(
            'task',
            'group_id',
            'folder_id',
        ));
    }

    public function edit(int $id, int $folder_id,int $task_id,EditGroupTask $request)
    {
        $this->checkRelation($id);

        // タスク編集内容をDBに保存
        $task=GroupTask::find($task_id);
        $task->title=$request->title;
        $task->status=$request->status;
        $task->due_date=$request->due_date;
        $task->save();

        $group_id=$id;
        $folder_id=$folder_id;

        return redirect()->route('groups.index',[
            'id' => $group_id,
            'folder_id' => $folder_id,
        ]);
    }
    
    public function showDeleteForm(int $id, int $folder_id,int $task_id)
    {
        $this->checkRelation($id);

        // タスク削除画面表示
        $task=GroupTask::find($task_id);

        $group_id=$id;
        $folder_id=$folder_id;

        return view('grouptask/delete',compact(
            'task',
            'group_id',
            'folder_id',
        ));
    }
    
    public function delete(int $id,int $folder_id,int $task_id)
    {
        $this->checkRelation($id);

        // タスク削除
        GroupTask::find($task_id)->delete();
        $group_id=$id;
        $folder_id=$folder_id;

        return redirect()->route('groups.index',[
            'id' => $group_id,
            'folder_id' => $folder_id,
        ]);
    }

    public function fixed(Request $request)
    {
        // タスクが画面上に配置された位置を取得
        // jsonによりタスクがドラッグで移動されると位置を取得する

        // 取得された位置をDBに保存して、配置された位置に固定
        $task = GroupTask::find($request->id);
        $task->top_position = $request->perY;
        $task->left_position = $request->perX;
        $task->save();

        $res= '成功';
        return $res;
    }

    // 意図しないURLアクセス対策
    private function checkRelation(int $id)
    {
        if(Auth::user()->groups()->first()->id != $id)
        {
            abort(404);
        }
    }
}
