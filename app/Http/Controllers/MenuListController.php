<?php

namespace App\Http\Controllers;

use App\pos\Category;
use Illuminate\Http\Request;

class MenuListController extends Controller
{
    public function index()
    {
        $list = Category::with("items")->get();
        return view("menu", compact("list"));
    }
}
