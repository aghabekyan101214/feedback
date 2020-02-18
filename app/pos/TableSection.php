<?php

namespace App\pos;

use Illuminate\Database\Eloquent\Model;

class TableSection extends Model
{
    public function tables()
    {
        return $this->hasMany("App\pos\Table", "section_id", "id");
    }
}
