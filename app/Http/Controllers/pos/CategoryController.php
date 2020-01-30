<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use App\pos\Category;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\helpers\FileUpload;

class CategoryController extends Controller
{

//    Path To the View Folder
    const FOLDER = "pos.categories";

//    Resource Title
    const TITLE = "Food Categories";

//    Resource Route
    const ROUTE = "/admin/pos/categories";

//    File Upload Folder in public/uploads
    const UPLOAD = "pos/categories";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = Category::orderBy("created_at", "DESC")->paginate(800);
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::FOLDER.".index", compact("data", "title", "route"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::FOLDER.".create", compact("title", "route"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'icon' => 'required|image|max:10000'
        ]);
        $file = FileUpload::upload(self::UPLOAD, $request->icon);

        $category = new Category();
        $category->name = $request->name;
        $category->icon = $file;
        $category->save();

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pos\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::FOLDER.".show", compact("category", "title", "route"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pos\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::FOLDER.".edit", compact("title", "route", "category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pos\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:100',
            'icon' => $request->icon != null ? 'required|image|max:10000' : ""
        ]);
        if(null != $request->icon) {
            $file = FileUpload::upload(self::UPLOAD, $request->icon);
            $category->icon = $file;
        }
        $category->name = $request->name;
        $category->save();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pos\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $file = $category->icon;
        $ans = $category->delete();
        if($ans) {
            unlink(public_path("uploads/$file"));
        }
        return redirect(self::ROUTE);
    }
}
