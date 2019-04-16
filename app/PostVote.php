<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostVote extends Model
{
    protected $table = 'post_votes';

    protected $fillable = ['post_id', 'user_id'];
}
