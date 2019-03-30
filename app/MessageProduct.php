<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageProduct extends Model
{
    protected $table = 'messages_product';

    public function conversationsProduct()
    {
        return $this->belongsTo('App\ConversationProduct', 'conversation_product_user', 'user_id', 'product_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
