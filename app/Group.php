<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;


class Group extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany('App\User','user_group');
    }

    public function group_folders()
    {
        return $this->hasMany('App\GroupFolder');
    }

}
