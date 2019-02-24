<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'hobbies';

    public function users(){
        return $this->belongsToMany('App\User', 'hobby_user', 'hobby_id', 'user_id');
    }
}
