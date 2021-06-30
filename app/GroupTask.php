<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GroupTask extends Model
{
    //
    use SoftDeletes;

    const STATUS =[
        1 => ['label' => "未着手" , 'class' => 'label-danger'],
        2 => ['label' => "着手中" , 'class' => 'label-info'],
        3 => ['label' => "完了" , 'class' => ''],
    ];

    public function getStatusLabelAttribute()
    {
        $status= $this->attributes['status'];

        if(!isset(self::STATUS[$status]))
        {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    public function getStatusClassAttribute()
    {
        $status= $this->attributes['status'];

        if(!isset(self::STATUS[$status]))
        {
            return '';
        }

        return self::STATUS[$status]['class'];
    }

    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
            ->format('Y/m/d');
    }

    public function private_tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment','task_id','id');
    }
    public function task_memos()
    {
        return $this->hasMany('App\TaskMemo','task_id','id');
    }
}
