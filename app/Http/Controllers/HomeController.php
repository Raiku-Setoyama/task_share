<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd('a')
        if(Auth::user()->folders()->first())
        {
            $folder=Auth::user()->folders()->first();

            return redirect()->route('tasks.index',[
                'id' => $folder->id,
            ]);
        }

        return view('/folders/create');
    }
}
