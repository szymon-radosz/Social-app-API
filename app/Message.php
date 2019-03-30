<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function conversations()
    {
        return $this->belongsTo('App\Conversation', 'conversation_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
