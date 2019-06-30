<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFeedback extends Model
{
    protected $table = 'user_feedback';

    protected $fillable = [
        'topic', 'message', 'user_id', 'status'
    ];
}
