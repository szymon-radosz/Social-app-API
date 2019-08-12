<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = ['type', 'message', 'user_id', 'status', 'sender_id', 'open_details_id'];

    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
