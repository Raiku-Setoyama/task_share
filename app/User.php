<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Mail\ResetPassword; // ★ 追加
use Illuminate\Support\Facades\Mail; // ★ 追加
use Illuminate\Foundation\Auth\User as Authenticatable;

// Notificationによるパスワード再設定
use App\Notifications\PasswordResetUserNotification;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function groups()
    {
        return $this->belongsToMany('App\Group','user_group');
    }
    public function folders()
    {
        return $this->hasMany('App\Folder');
    }
    public function group_tasks()
    {
        return $this->hasMany('App\GroupTask');
    }

    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)->send(new ResetPassword($token));
    }

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new PasswordResetUserNotification($token));    
    // }  
}
