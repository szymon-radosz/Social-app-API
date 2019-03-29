<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'name', 'category_id', 'child_gender', 'price', 'lat', 'lng', 'state', 'status'
    ];

    public function productPhotos()
    {
        return $this->hasMany('App\ProductPhoto', 'product_id');
    }

    public function categories()
    {
        return $this->hasOne('App\ProductCategoryPivot', 'product_id');
    }
}
