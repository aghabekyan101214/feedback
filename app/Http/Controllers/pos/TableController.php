<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use App\pos\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    //    Path To the View Folder
    const FOLDER = "pos.tables";

//    Resource Title
    const TITLE = "Tables";

//    Resource Route
    const ROUTE = "/admin/pos/tables";


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Table::paginate(800);
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
            'name' => 'required|max:255',
        ]);

        $category = new Table();
        $category->name = $request->name;
        $category->save();

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     * @param  \App\pos\Table $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::FOLDER.".show", compact("table", "title", "route"));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\pos\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        return view(self::FOLDER.".edit", compact("title", "route", "table"));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pos\Table  $tables
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $table->name = $request->name;
        $table->save();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\pos\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        $table->delete();
        return redirect(self::ROUTE);
    }
}
