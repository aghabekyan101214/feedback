<?php

namespace App\Http\Controllers\api\pos;

use App\helpers\ValidateNullFields;
use App\Http\Controllers\Controller;
use App\pos\Item;
use App\pos\Order;
use App\pos\OrdersList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\helpers\ResponseHelper;
use App\Http\Resources\pos\OrderCollection;
use Illuminate\Support\Facades\URL;

class OrderController extends Controller
{
    public function getOrders(Request $request)
    {
        $limit = $request->limit ?? 200;
        $data = Order::select("id", "status")->with(["tables" => function($query) {
            $query->select("name", "section_id");
        }])->whereDate("created_at", Carbon::today())->orWhereDate("created_at", Carbon::yesterday())->orderBy("status")->orderBy("created_at", "DESC")->paginate($limit);
        foreach ($data as $bin => $d) {
//            $data[$bin]['sum'] = floatval(OrdersList::selectRaw("SUM(quantity * price) as sum, order_id")->where("order_id", $d->id)->groupBy("order_id")->first()->sum);
            $data[$bin]['sum'] = 5000;
        }
        return ResponseHelper::success($data, true);
    }

    public function getOrderList(Request $request)
    {
        $fields = ["order"];
        ValidateNullFields::validate($request, $fields);
        $limit = intval($request->limit ?? 200);
        $ordersList = OrdersList::selectRaw("id, quantity, notes, price, item_id, round( CAST(float8 (quantity * price) as numeric), 2) as total")->with(["items" => function($query) {
            $query->selectRaw("name, id");
        }])->where("order_id", intval($request->order))->paginate($limit);
        return ResponseHelper::success($ordersList, true);
    }

    public function manageStoreOrder(Request $request)
    {
        $fields = ["item_id", "quantity", "order", "tableId"];
        ValidateNullFields::validate($request, $fields);

        $order = new Order();
        $order->save();
        $order->tables()->sync($request->tableId);
        $msg = $this->storeOrder($request->order, $order);

        return ResponseHelper::success(array(), false, $msg);
    }

    private function storeOrder($list, Order $order)
    {
        foreach ($list as $o) {
            $item = Item::find($o["id"]);
            $list = new OrdersList();
            $list->item_id = $o['id'];
            $list->quantity = $o['quantity'];
            $list->price = $item->price;
            $list->notes = $o['notes'];
            $order->ordersList()->save($list);
        }
        return "You Have Ordered Successfully";
    }
}
