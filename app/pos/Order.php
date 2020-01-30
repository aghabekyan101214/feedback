<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function ordersList()
    {
        return $this->hasMany("App\pos\OrdersList", "order_id", "id");
    }

    public function tables()
    {
        return $this->belongsTo("App\pos\Table", "table_id", "id");
    }
}
