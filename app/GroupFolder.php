<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GroupFolder extends Model
{
    use SoftDeletes;
    //
    public function group_tasks()
    {
        return $this->hasMany('App\GroupTask');
    }

}
