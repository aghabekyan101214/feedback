<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $folder = "employees";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(50);
        return view("$this->folder.index", compact("employees"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("$this->folder.create");
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
            "name_en" => "required|max:255",
            "name_fr" => "required|max:255",
            "name_ar" => "required|max:255",
            "active"  => "required",
        ]);

        $employee = new Employee();
        $employee->name_en = $request->name_en;
        $employee->name_fr = $request->name_fr;
        $employee->name_ar = $request->name_ar;
        $employee->active  = $request->active;
        $employee->save();

        return redirect('/admin/employees');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view("$this->folder.show", compact("employee"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view("$this->folder.edit", compact("employee"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            "name_en" => "required|max:255",
            "name_fr" => "required|max:255",
            "name_ar" => "required|max:255",
            "active"  => "required",
        ]);

        $employee->name_en = $request->name_en;
        $employee->name_fr = $request->name_fr;
        $employee->name_ar = $request->name_ar;
        $employee->active  = $request->active;
        $employee->save();

        return redirect('/admin/employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect("/admin/employees");
    }

    public function change_status(Request $request)
    {
        $employee = Employee::find($request->id);
        $employee->active = $request->status;
        $employee->save();
    }
}
