<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function sections()
    {
        return $this->belongsTo("App\pos\TableSection", "section_id", "id");
    }
}
