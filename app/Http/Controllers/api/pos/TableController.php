<?php

namespace App\Http\Controllers\api\pos;

use App\Http\Controllers\Controller;
use App\pos\Order;
use App\pos\Table;
use Illuminate\Http\Request;
use App\pos\TableSection;
use App\helpers\ResponseHelper;

class TableController extends Controller
{
    public function getTables()
    {
        $sections = TableSection::select("id", "name")->with(["tables" => function($query) {
            $query->select("name", "id", "section_id");
            $query->with(["orders" => function($query) {
                $query->where("status", Order::STATUS_OPENED);
            }]);
        }])->get();

        foreach($sections as $bin => $section) {
            foreach ($section->tables as $tbin => $table){
                foreach ($table->orders as $obin => $order) {
                    $section->tables[$tbin]['group_id'] = $order->id;
                }
                unset($table->orders);
            }
        }
        return ResponseHelper::success($sections);
    }

    public function getBusyTables()
    {
        $tables = Table::with(["orders" => function($query) {

        }])->get();
    }
}
