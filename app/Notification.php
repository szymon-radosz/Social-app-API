<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = ['type', 'message', 'user_id', 'status'];

    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
