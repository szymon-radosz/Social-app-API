<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryPivot extends Model
{
    protected $table = 'category_product';

    protected $fillable = [
        'product_id', 'category_id'
    ];
}
