<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function categories()
    {
        return $this->belongsTo('App\pos\Category', 'category_id', 'id');
    }
}
