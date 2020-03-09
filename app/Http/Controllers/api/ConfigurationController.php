<?php

namespace App\Http\Controllers\api;

use App\Configuration;
use App\Http\Controllers\Controller;
use App\helpers\ResponseHelper;

class ConfigurationController extends Controller
{
    public function index()
    {
        $resp = array(
            "is_manager" => true,
            "is_waiter" => true,
        );

        return ResponseHelper::success($resp);
    }
}
