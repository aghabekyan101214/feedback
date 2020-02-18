<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\helpers\ResponseHelper;

class ConfigurationController extends Controller
{
    public function getConfiguration()
    {
        $resp = array(
            "is_manager" => true,
            "is_waiter" => true,
        );

        return ResponseHelper::success($resp);
    }
}
