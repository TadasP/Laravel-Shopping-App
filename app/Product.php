<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function shop()
    {
        return $this->hasOne('App\Shop', 'id', 'shop_id');
    }

    public function categoriesId()
    {
        return $this->hasMany('App\CattegoryProductRelation', 'product_id', 'id');
    }
}
