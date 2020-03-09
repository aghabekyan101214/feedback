<?php

namespace App\Http\Controllers\api;

use App\Configuration;
use App\Http\Controllers\Controller;
use App\helpers\ResponseHelper;

class ConfigurationController extends Controller
{
    public function index()
    {
        $config = Configuration::select("update_time")->first();
        $resp = array(
            "is_manager" => true,
            "is_waiter" => true,
            "last_update" => $config->update_time ?? 0
        );

        return ResponseHelper::success($resp);
    }
}
