<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryPivot extends Model
{
    protected $fillable = [
        'product_id', 'category_id'
    ];

    protected $table = 'category_product';
}
