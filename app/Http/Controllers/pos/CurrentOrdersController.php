<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use App\pos\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CurrentOrdersController extends Controller
{

    //    Path To the View Folder
    const FOLDER = "pos.currentOrders";

//    Resource Title
    const TITLE = "Current Orders";

//    Resource Route
    const ROUTE = "/admin/pos/current-orders";

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $data = Order::with(["ordersList" => function($query) {
            $query->with("items");
        }])->whereDate("created_at", Carbon::today())
            ->orWhereDate("created_at", Carbon::yesterday())
            ->orderBy("status")
            ->orderBy("created_at", "DESC")
            ->get();
        $title = self::TITLE;
        $route = self::ROUTE;
        $length = count($data);
        return view(self::FOLDER.".index", compact("title", "route", "data", "length"));
    }

    public function changeStatus($orderId) {
        $order = Order::find($orderId);
        $order->status = 1;
        $status = $order->save();
        if($status) {
            return response()
                ->json([
                    "message" => "You have successfully Closed The Order",
                    "success" => true,
                    "error"   => ""
                ]);
        }
        return response()
            ->json([
                "message" => "Something went wrong while changing the status, please try again.",
                "success" => false,
                "error"   => ""
            ]);
    }
}
