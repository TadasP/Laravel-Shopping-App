<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function products()
    {
        return $this->hasMany('App\Product', 'shop_id', 'id')->where('active', '=', 1);
    }

    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'owner_id');
    }
}
