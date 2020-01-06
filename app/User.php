<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'blocked', 'admin_role', 'email', 'password', 'platform', 'age', 'lattitude', 'longitude', 'location_string', 'description', 'email_token', 'api_token', 'platform', 'nickname',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hobbies()
    {
        return $this->belongsToMany('App\Hobby', 'hobby_user', 'user_id', 'hobby_id');
    }

    public function conversations()
    {
        return $this->belongsToMany('App\Conversation', 'conversation_user');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote', 'user_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Post', 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification', 'user_id');
    }
}
