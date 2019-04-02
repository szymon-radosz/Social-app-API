<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';

    protected $fillable = [
        'user_id', 'vote', 'message', 'author_id'
    ];
}
