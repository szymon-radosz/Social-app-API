<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $table = 'translations';

    protected $fillable = ['name', 'en', 'de', 'fr', 'es', 'zh'];
}
