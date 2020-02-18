<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use App\pos\Table;
use App\pos\TableSection;
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
     */
    public function index()
    {
        $data = Table::with("sections")->paginate(8000);
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
        $sections = TableSection::all();
        return view(self::FOLDER.".create", compact("title", "route", "sections"));
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
            'section_id' => 'required|integer'
        ]);

        $table = new Table();
        $table->name = $request->name;
        $table->section_id = $request->section_id;
        $table->save();

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     * @param  \App\pos\Table $table
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
     */
    public function edit(Table $table)
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $sections = TableSection::all();
        return view(self::FOLDER.".edit", compact("title", "route", "table", "sections"));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pos\Table  $tables
     */
    public function update(Request $request, Table $table)
    {
        $request->validate([
            'name' => 'required|max:255',
            'section_id' => 'required|integer'
        ]);

        $table->name = $request->name;
        $table->section_id = $request->section_id;
        $table->save();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\pos\Table  $table
     */
    public function destroy(Table $table)
    {
        $table->delete();
        return redirect(self::ROUTE);
    }
}
