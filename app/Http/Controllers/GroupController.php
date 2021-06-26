<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateGroup;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Task;
use App\Group;
use App\GroupFolder;
use App\GroupTask;


class GroupController extends Controller
{
    public function home(){
        // 条件分岐により、
        // 既にグループに所属していればグループへ、所属していなければグループ作成/検索画面へ
        $user = Auth::user();

        // 所属グループがあるかどうか
        if(User::find($user->id)->groups()->first())
        {
            // グループ参加許可が出てる(group_status=2)か出ていないか(group_status=1)
            if($user->group_status == 2)
            {
                $user_group=$user->groups()->first();

                //グループに紐づくフォルダがあれば取得
                if(Group::find($user_group->id)->group_folders()->first())
                {
                    $group_folder=Group::find($user_group->id)->group_folders()->first();
                    
                    return redirect()->route('groups.index',[
                        'id' => $user_group->id,
                        'folder_id' => $group_folder->id,
                    ]);
                }else{
                    return redirect()->route('group_folders.create',[
                        'id' => $user_group->id,
                    ]);
                }
            }else{
                return view('groups/wait');
            }
        }else{
            $results=[];
            return view('groups/home',compact('results'));
    }
}

    public function search(Request $request){
        // パスワードによるグループ検索
        
        $results=[];
        $groups= Group::all();
        $keyword=$request->search;
        
        // 入力されたパスワードに一致するグループがあれば取得
        if(isset($keyword)){
            
            foreach($groups as $group) 
            {
                if(Hash::check($keyword, $group->password)){
                    
                    $results = $group;
                }
            }
        }

        return view('groups/home',compact('results'));
    }
    
    public function entry(int $id){
        // グループに入る際にUserとGroupを紐づける
        
        $user = Auth::user();
        $group=Group::find($id);
        $user_id=$user->id;
        User::find($user_id)->groups()->save($group);
        
        // 管理者の許可後にgroup_status=2となり、グループに入れる。
        $user =User::find($user_id);
        $user->group_status = 1;
        $user->save();

        return redirect()->route('group.home');
    }

    public function index(int $id, int $folder_id)
    {
        $this->checkRelation($id);

        // 個人へ戻るためのフォルダid取得
        if(Auth::user()->folders()->first()){
            $folder=Auth::user()->folders()->first();
            $first_folder_id=$folder->id;
        }else{
            $first_folder_id=null;
        }
        
        $user_id=Auth::user()->id;
        $group=User::find($user_id)->groups()->first();
        
        // グループに紐づいたフォルダ
        $group_folders=Group::find($id)->group_folders()->get();
        $current_folder_id = $folder_id;
        
        // フォルダに紐づいたタスク
        $complete_tasks =GroupTask::where('group_folder_id', '=', $folder_id)->where('status', '=', 3)->orderBy('updated_at','desc')->get();
        $doing_tasks = GroupTask::where('group_folder_id', '=', $folder_id)->where('status', '<', 3)->get();
        
        // メンバー一覧表示
        $group_members = Group::find($id)->users()->get();
        
        // 各メンバーの担当タスク数を取得
        // タスクのuser_idを配列にいれる
        $task= $doing_tasks->where('user_id','!=',null);
        $task_user_id = $task ->pluck('user_id');
        $array_task_user_id = $task_user_id ->toArray();
        
        // 配列内の同じuser_idの個数をカウントすることでUserの担当タスク数を取得
            if($array_task_user_id){
                $user_id_count = array_count_values($array_task_user_id);
            }else{
                $user_id_count = 0;
            }
        
        // 管理者権限
        $users = Group::find($id)->users()->get();
        $wait_users = $users->where('group_status' , '=' , 1);
        

        return view('groups/index',compact(
        'group',
        'first_folder_id',
        'group_folders',
        'current_folder_id',
        'doing_tasks',
        'complete_tasks',
        'group_members',
        'user_id_count',
        'wait_users'
    ));
    }

    public function showCreateForm()
    {
        // グループ作成画面
        return view('groups/create');
    }

    public function create(CreateGroup $request)
    {
        // グループをDBに保存・作成
        $group = new Group;
        $group->name= $request->name;
        $group->password = Hash::make($request->password);

        // Userとの中間テーブルに挿入、紐づけ
        $user=Auth::user();
        User::find($user->id)->groups()->save($group);

        // グループ作成者を管理者にする
        $user->role = 1;
        $user->group_status =2;
        $user->save();

        // フォルダ作成画面へ移動
        return redirect()->route('group_folders.create',[
            'id' => $group->id,
        ]);
    }

    public function out(int $id)
    {
        $this->checkRelation($id);

        $user= Auth::user();
        $user->role = 2;
        $user->group_status = 0;
        $user->save();
        
        // 担当タスクの紐づけ解除
        $group_tasks = User::find($user->id)->group_tasks()->get();
        foreach($group_tasks as $task)
        {
            $task->user_id = null;
            $task->working_user_name = null;
            $task->save();
        }
        // グループ退会
        Group::find($id)->users()->detach($user->id);

        return redirect()->route('home');
    }

    public function right(int $id, int $folder_id, int $user_id)
    {
        $this->checkRelation($id);

        // 管理者がメンバーの加入を許可する(group_status = 2)
        $user=User::find($user_id);
        $user->group_status = 2;
        $user->save();
        
        $id=$id;
        $folder_id=$folder_id;

        return redirect()->route('groups.index',[
            'id' => $id,
            'folder_id' => $folder_id,
        ]);
    }

    public function delete(Request $request)
    {
        $delete_group_id = $request->group_id;
        Group::find($delete_group_id)->delete();

        return redirect()->route('group.home');
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


