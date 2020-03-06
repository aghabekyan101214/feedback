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
        return ResponseHelper::success($config);
    }
}
