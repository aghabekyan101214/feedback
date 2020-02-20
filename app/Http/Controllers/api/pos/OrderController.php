<?php

namespace App\Http\Controllers\api\pos;

use App\helpers\ValidateNullFields;
use App\Http\Controllers\Controller;
use App\pos\Item;
use App\pos\Order;
use App\pos\OrdersList;
use App\pos\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\helpers\ResponseHelper;
use App\Http\Resources\pos\OrderCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class OrderController extends Controller
{
    public function getOrders(Request $request)
    {
        $limit = $request->limit ?? 200;
        $search_query = strtolower($request->search_query);

        $sql = $this->generateSql($limit, $search_query);
        $data = $sql->paginate($limit);

        $resp = $this->parseData($data);
        return ResponseHelper::success($resp, true);
    }

    private function generateSql($limit, $search_query)
    {
        return Order::select("orders.id", "orders.status")
            ->where(function($query) use($search_query) {
                $query->where("orders.id", "ILIKE", $search_query);
                $query->orWhere("tables.name", "ILIKE", "$search_query%");
            })
            ->join("orders_tables", "order_id", "=", "orders_tables.order_id")
            ->join("tables", "tables.id", "=", "orders_tables.table_id")
            ->where(function($query) {
                $query->whereDate("orders.created_at", Carbon::today());
                $query->orWhereDate("orders.created_at", Carbon::yesterday());
            })
            ->groupBy("orders.id");
    }

    private function parseData($data)
    {
        foreach ($data as $bin => $d) {
            $sum = floatval(OrdersList::selectRaw("SUM(quantity * price) as sum, order_id")->where("order_id", $d->id)->groupBy("order_id")->first()->sum ?? 0);
            $tables = Table::select("tables.id", "name")
                ->join("orders_tables", "tables.id", "=", "orders_tables.table_id")
                ->where("orders_tables.order_id", $d->id)
                ->get();
            $data[$bin]['sum'] = $sum;
            $data[$bin]['tables'] = $tables;
        }
        return $data;
    }

    public function getOrderList(Request $request)
    {
        $fields = ["order"];
        ValidateNullFields::validate($request, $fields);
        $limit = intval($request->limit ?? 200);
        $search_query = strtolower($request->search_query);
//        $ordersList = OrdersList::selectRaw("id, quantity, notes, price, item_id, round( CAST(float8 (quantity * price) as numeric), 2) as total")
//            ->with(["items" => function($query) {
//            $query->selectRaw("name, id");
//        }])->where("order_id", intval($request->order))->paginate($limit);
        $ordersList = OrdersList::selectRaw("orders_list.id, quantity, notes, items.price, item_id, round( CAST(float8 (orders_list.quantity * items.price) as numeric), 2) as total, items.name as item_name")
            ->join("items", "items.id", "=", "orders_list.item_id")
            ->orderBy("orders_list.id")
            ->where(function($query) use($search_query) {
                $query->where("items.name", "ILIKE", "%$search_query%");
                $query->orWhere("items.id", "ILIKE", "$search_query");
            })
            ->where("order_id", intval($request->order))
            ->paginate($limit);
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
