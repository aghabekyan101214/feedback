<?php

namespace App\Http\Controllers\pos;

use App\pos\Category;
use App\pos\Item;
use App\pos\Order;
use App\Http\Controllers\Controller;
use App\pos\OrdersList;
use App\pos\Table;
use App\pos\TableSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //    Path To the View Folder
    const FOLDER = "pos.orders";

//    Resource Title
    const TITLE = "Food Categories";

//    Resource Route
    const ROUTE = "/admin/pos/categories";


    /**
     * Display a listing of the resource.
     *
     */
    public function index($orderId = null)
    {
        $categories = Category::with("items")->orderBy("name")->paginate(800);
        $items = Item::all();
        $title = self::TITLE;
        $route = self::ROUTE;
        $tables = Table::all();
        $sections = TableSection::with("tables")->get();
        $orderData = OrdersList::with(["items"])->where("order_id", $orderId)->get();
        $order = array();
        $orderWithTables = Order::with("tables")->find($orderId);
        $tableId = [];
        if(null != $orderId) {
            foreach ($orderWithTables->tables as $table) {
                $tableId[] = $table->id;
            }
        }
        foreach ($orderData as $d) {
            $order[] = array(
                "id" => $d->item_id,
                "quantity" => $d->quantity,
                "name" => $d->items->name,
                "img" => url("/uploads")."/".$d->items->icon,
                "price" => $d->price,
                "notes" => $d->notes
            );
        }
        return view(self::FOLDER.".index", compact("categories", "title", "route", "items", "tables", "order", "tableId", "orderId", "sections"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function store(Request $request, $orderId = null)
    {
        if(null == $request->tableId || !is_array($request->tableId)) {
            return response()
                ->json([
                    "message" => "Wrong Table Selected",
                    "success" => true,
                    "error" => "Wrong Table Selected"
                ]);
        }
        $order = $orderId == null ? new Order() : Order::find($orderId);
        $order->save();
        $order->tables()->sync($request->tableId);
        if(null != $request->order) {
            foreach ($request->order as $o) {
                $list = new OrdersList();
                $list->item_id = $o['id'];
                $list->quantity = $o['quantity'];
                $list->price = $o['price'];
                $list->notes = $o['notes'];
                $order->ordersList()->save($list);
            }
            return response()
                ->json([
                    "message" => "You have ordered successfully",
                    "success" => true,
                    "error" => ""
                ]);
        }
        return response()
            ->json([
                "message" => "Please, Choose at Least One Item",
                "success" => false,
                "error" => "Please, Choose at Least One Item"
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pos\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pos\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pos\Order  $order
     */
    public function update(Request $request, $id)
    {
        OrdersList::where("order_id", $id)->delete();
        $resp = $this->store($request, $id);
        return $resp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pos\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * Edit Current Order
     *
     * @param  $orderId
     * @return \Illuminate\Http\Response
     */
    public function editOrder($id)
    {
        return $this->index($id);
    }
}
