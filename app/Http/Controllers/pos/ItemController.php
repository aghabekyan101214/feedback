<?php

namespace App\Http\Controllers\pos;

use App\helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\pos\Category;
use App\pos\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //    Path To the View Folder
    const FOLDER = "pos.items";

//    Resource Title
    const TITLE = "Items";

//    Resource Route
    const ROUTE = "/admin/pos/items";

//    File Upload Folder in public/uploads
    const UPLOAD = "pos/items";

    public function index()
    {
        $data = Item::orderBy("created_at", "DESC")->paginate(5000);
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::FOLDER.".index", compact("data", "title", "route"));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $categories = Category::all();
        return view(self::FOLDER.".create", compact("title", "route", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'icon' => 'required|image|max:10000',
            'category_id' => 'required|numeric',
            'price' => 'required|numeric|min:0|max:100000'
        ]);
        $file = FileUpload::upload(self::UPLOAD, $request->icon);
        $item = new Item();
        $item->name = $request->name;
        $item->icon = $file;
        $item->category_id = $request->category_id;
        $item->price = $request->price;
        $item->save();

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pos\Item  $item
     */
    public function show(Item $item)
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::FOLDER.".show", compact("item", "title", "route"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pos\Item  $item
     */
    public function edit(Item $item)
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $categories = Category::all();
        return view(self::FOLDER.".edit", compact("title", "route", "item", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pos\Item  $item
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|max:255',
            'icon' => $request->icon != null ? 'required|image|max:10000' : "",
            'category_id' => 'required|numeric',
            'price' => 'required|numeric|min:0|max:100000'
        ]);
        if(null != $request->icon) {
            $file = FileUpload::upload(self::UPLOAD, $request->icon);
            unlink(public_path("uploads/$item->icon"));
            $item->icon = $file;
        }
        $item->name = $request->name;
        $item->category_id = $request->category_id;
        $item->price = $request->price;
        $item->save();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pos\Item  $item
     */
    public function destroy(Item $item)
    {
        $file = $item->icon;
        $ans = $item->delete();
        if($ans) {
            unlink(public_path("uploads/$file"));
        }
        return redirect(self::ROUTE);
    }
}
