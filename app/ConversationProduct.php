<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConversationProduct extends Model
{
    protected $table = 'conversations_product';

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function messages()
    {
        return $this->hasMany('App\MessageProduct');
    }
}
