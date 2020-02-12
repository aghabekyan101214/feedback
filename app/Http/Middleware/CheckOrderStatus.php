<?php

namespace App\Http\Middleware;

use Closure;
use App\pos\Order;

class CheckOrderStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $order = Order::findOrFail($request->route()->parameter('id'));
        if($order->status == 1) {
            return abort(404);
        }
        return $next($request);
    }
}
