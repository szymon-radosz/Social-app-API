<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'friends';

    protected $fillable = ['sender_id', 'receiver_id', 'confirmed'];

    //return users data in friendship where I(first person) invited them to friendship
    public function usersInvitedByMe()
    {
        return $this->belongsTo('App\User', 'receiver_id');
    }

    //return users data in friendship where someone(second person) invited me to friendship
    public function usersInvitedMe()
    {
        return $this->belongsTo('App\User', 'sender_id');
    }
}
