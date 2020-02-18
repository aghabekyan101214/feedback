<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $hidden = ['pivot'];

    public function sections()
    {
        return $this->belongsTo("App\pos\TableSection", "section_id", "id");
    }

    public function orders()
    {
        return $this->belongsToMany("App\pos\Order", "orders_tables", "table_id", "order_id");
    }
}
