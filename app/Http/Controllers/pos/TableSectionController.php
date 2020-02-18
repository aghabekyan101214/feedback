<?php

namespace App\Http\Controllers\pos;

use App\pos\TableSection;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableSectionController extends Controller
{

    //    Path To the View Folder
    const FOLDER = "pos.sections";

//    Resource Title
    const TITLE = "Table Sections";

//    Resource Route
    const ROUTE = "/admin/pos/sections";

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $sections = TableSection::paginate(10000);
        return view(self::FOLDER . ".index", compact("title", "route", "sections"));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $action = "create";
        return view(self::FOLDER.".create", compact("title", "route", "action"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|max:100"
        ]);

        $section = new TableSection();
        $section->name = $request->name;
        $section->save();

        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TableSection  $tableSection
     * @return \Illuminate\Http\Response
     */
    public function show(TableSection $tableSection)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pos\TableSection  $tableSection
     */
    public function edit($id)
    {
        $tableSection = TableSection::findOrFail($id);
        $title = self::TITLE;
        $route = self::ROUTE;
        $action = "update";
        return view(self::FOLDER.".create", compact("title", "route", "action", "tableSection"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TableSection  $tableSection
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required|max:100"
        ]);
        $tableSection = TableSection::findOrFail($id);
        $tableSection->name = $request->name;
        $tableSection->save();

        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TableSection  $tableSection
     */
    public function destroy($id)
    {
        TableSection::find($id)->delete();
        return redirect(self::ROUTE);
    }
}
