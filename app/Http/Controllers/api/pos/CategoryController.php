<?php

namespace App\Http\Controllers\api\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\pos\Category;
use App\helpers\ResponseHelper;
use Illuminate\Support\Facades\URL;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $base = URL::to('/');
        $categories = Category::selectRaw("id, name, concat('$base/uploads/', icon) as icon")->get();
        return ResponseHelper::success($categories);
    }
}
