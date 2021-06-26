<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Group;
use App\GroupFolder;
use Illuminate\Http\Request;
use App\Http\Requests\FolderCreate;



class GroupFolderController extends Controller
{
    public function showCreateForm(int $id)
    {
        $this->checkRelation($id);

        //フォルダ作成画面表示
        $current_group_id = $id;

        return view('groupfolder/create',compact('current_group_id'));
    }

    public function create(int $id,FolderCreate $request)
    {
        // $this->checkRelation($id);

        // フォルダを所属グループに紐づけてDBに保存・作成
        $group_folder = new GroupFolder;
        $group_folder->title = $request->title;

        $current_group_id = $id;
        Group::find($current_group_id)->group_folders()->save($group_folder);

        return redirect()->route('groups.index', [
            'id' => $current_group_id,
            'folder_id' => $group_folder->id,
        ]);

        
    }

    public function showDeleteForm(int $id, int $folder_id)
    {
        $this->checkRelation($id);

        // フォルダ削除画面表示
        $group_folder=GroupFolder::find($folder_id);

        $group_id=$id;

        return view('groupfolder/delete',compact(
            'group_folder',
            'group_id',
        ));
    }

    public function delete(int $id, int $folder_id)
    {
        $this->checkRelation($id);

        // フォルダ削除
        GroupFolder::find($folder_id)->delete();
        
        $group_id=$id;
        $return_folder=Group::find($id)->group_folders()->first();

        return redirect()->route('groups.index',[
            'id' =>$group_id,
            'folder_id' =>$return_folder->id,
        ]);

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
