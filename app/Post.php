<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function author()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'type_id', 'id')->where('type', '=', 1);
    }
}
