<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCommentVote extends Model
{
    protected $table = 'post_comment_votes';

    protected $fillable = ['comment_id', 'user_id'];
}
