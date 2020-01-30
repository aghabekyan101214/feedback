<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class OrdersList extends Model
{
    protected $table = "orders_list";

    public function items()
    {
        return $this->belongsTo("App\pos\Item", "item_id","id");
    }
}
