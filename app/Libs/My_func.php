<?php

namespace App\Libs;

use App\User;
use App\GroupTask;

class My_func{

    public static function working_user($task)
    {
        $working_user_id=$task->user_id;
    
        $working_user_name=User::find($working_user_id)->name;
    
        return $working_user_name;
    }
}
