<?php

namespace App\Http\Controllers\api\pos;

use App\helpers\ValidateNullFields;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\pos\Item;
use App\helpers\ResponseHelper;
use Illuminate\Support\Facades\URL;

class ItemController extends Controller
{
    public function getItems(Request $request)
    {
        $fields = ["category"];
        ValidateNullFields::validate($request, $fields);
        $limit = intval($request->limit ?? 200);
        $base = URL::to('/');
        $items = Item::selectRaw("id, name, price, concat('$base/uploads/', icon)")->where("category_id", intval($request->category))->paginate($limit);
        return ResponseHelper::success($items, true);
    }
}
