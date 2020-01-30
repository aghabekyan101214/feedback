<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function items()
    {
        return $this->hasMany('App\pos\Item', 'category_id', 'id');
    }
}
