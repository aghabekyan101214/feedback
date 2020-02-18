<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    const STATUS_OPENED = 0; // The Order Is In Progress
    const STATUS_CLOSED = 1; // The Order Is Closed

    protected $hidden = ['pivot'];

    public function ordersList()
    {
        return $this->hasMany("App\pos\OrdersList", "order_id", "id");
    }

    public function tables()
    {
        return $this->belongsToMany("App\pos\Table", "orders_tables", "order_id", "table_id");
    }

}
