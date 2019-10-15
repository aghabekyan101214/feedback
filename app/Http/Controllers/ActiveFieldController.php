<?php

namespace App\Http\Controllers;

use App\ActiveField;
use Illuminate\Http\Request;

class ActiveFieldController extends Controller
{

    private $folder = "active_fields";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields = ActiveField::paginate(100);
        return view("$this->folder.index", compact("fields"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ActiveField  $activeField
     * @return \Illuminate\Http\Response
     */
    public function show(ActiveField $activeField)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActiveField  $activeField
     * @return \Illuminate\Http\Response
     */
    public function edit(ActiveField $activeField)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActiveField  $activeField
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActiveField $activeField)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActiveField  $activeField
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActiveField $activeField)
    {
        //
    }

    public function change_status(Request $request)
    {
        $field = ActiveField::find($request->id);
        $field->active = $request->status;
        $field->save();
    }
}
