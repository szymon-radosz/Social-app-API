<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'friends';

    protected $fillable = ['sender_id', 'receiver_id', 'confirmed'];
}
