<?php

namespace App\Http\Controllers\api\pos;

use App\Http\Controllers\Controller;
use App\pos\Item;
use App\pos\Order;
use App\pos\OrdersList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\helpers\ResponseHelper;
use App\Http\Resources\pos\OrderCollection;

class OrderController extends Controller
{
    public function getOrders(Request $request)
    {
        $limit = $request->limit ?? 200;
        $data = Order::with(["tables" => function($query) {
            $query->select("name", "id");
        }])->whereDate("created_at", Carbon::today())->orWhereDate("created_at", Carbon::yesterday())->orderBy("status")->orderBy("created_at", "DESC")->paginate($limit);
        foreach ($data as $bin => $d) {
            $data[$bin]['sum'] = floatval(OrdersList::selectRaw("SUM(quantity * price) as sum, order_id")->where("order_id", $d->id)->groupBy("order_id")->first()->sum);
            unset($data[$bin]["created_at"]);
            unset($data[$bin]["updated_at"]);
        }
        return ResponseHelper::success($data, true);
    }
}
