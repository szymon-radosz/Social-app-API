<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $table = 'post_comments';

    protected $fillable = ['body', 'user_id', 'post_id'];

    public function users(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function votes(){
        return $this->hasMany('App\PostCommentVote', 'comment_id');
    }
}
