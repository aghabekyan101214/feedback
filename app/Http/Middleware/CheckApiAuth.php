<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\helpers\ResponseHelper;

class CheckApiAuth
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
        $user = User::where("token", $request->bearerToken())->first();
        if(null == $user) {
            return ResponseHelper::fail("Unauthorized", 401);
        }
        return $next($request);
    }
}
