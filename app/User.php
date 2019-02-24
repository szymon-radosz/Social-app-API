<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'age', 'lattitude', 'longitude', 'description', 'email_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function kids()
    {
        return $this->hasMany('App\Kid', 'user_id');
    }

    public function hobbies()
    {
        return $this->belongsToMany('App\Hobby', 'hobby_user', 'hobby_id', 'user_id');
    }
}
