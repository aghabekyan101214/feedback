<?php

namespace App\Http\Controllers\api\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\pos\TableSection;
use App\helpers\ResponseHelper;

class TableController extends Controller
{
    public function getTables()
    {
        $tables = TableSection::select("id", "name")->with(["tables" => function($query) {
            $query->select("name", "id", "section_id");
        }])->get();
        return ResponseHelper::success($tables);
    }
}
