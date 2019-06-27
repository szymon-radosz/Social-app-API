<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    protected $table = 'user_report';

    protected $fillable = [
        'topic', 'message', 'user_id', 'status'
    ];
}
