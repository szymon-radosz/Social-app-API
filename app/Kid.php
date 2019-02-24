<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kid extends Model
{
    protected $fillable = [
        'user_id', 'name', 'date_of_birth'
    ];
}
