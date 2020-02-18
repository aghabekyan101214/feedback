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
            $query->with(["orders"]);
        }])->get();
        foreach($sections as $bin => $section) {
            foreach ($section->tables as $tbin => $table){
                if(!isset($table->orders[0])) {
                    $section->tables[$tbin]['is_busy'] = false;
                }
                foreach ($table->orders as $obin => $order) {

                    if($order->status == Order::STATUS_OPENED) {
                        $section->tables[$tbin]['is_busy'] = true;
                    } else {
                        $section->tables[$tbin]['is_busy'] = false;
                    }
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
