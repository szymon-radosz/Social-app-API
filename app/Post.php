<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['title', 'description', 'category_id', 'user_id'];

    public function categories()
    {
        return $this->hasOne('App\PostCategory', 'category_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\PostComment', 'post_id');
    }

    public function votes(){
        return $this->hasMany('App\PostVote', 'post_id');
    }
}
