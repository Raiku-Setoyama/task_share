<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\FolderCreate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FolderController extends Controller
{
    public function showCreateForm()
    {
        //フォルダ作成画面表示
        return view('folders/create');
    }

    public function create(FolderCreate $request)
    {
        // フォルダをDBに保存
        $folder = new Folder();
        $folder->title=$request->title;
        Auth::user()->folders()->save($folder);

        return redirect()->route('tasks.index',
        [
            'id' => $folder->id,
        ]);
    }

    public function showDeleteForm(int $id)
    {
        $this->checkRelation($id);

        // フォルダ削除画面表示
        $folder=Folder::find($id);

        return view('folders/delete',compact(
            'folder',
        ));
    }

    public function delete(int $id)
    {
        $this->checkRelation($id);

        // フォルダ削除
        Folder::find($id)->delete();
        
        $folder_id=Folder::first()->id;

        return redirect()->route('tasks.index',[
            'id' =>$folder_id ,
        ]
        );
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
