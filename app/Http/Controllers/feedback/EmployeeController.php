<?php

namespace App\Http\Controllers\feedback;

use App\Employee;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{

    private $folder = "feedback.employees";
    private $upload = "employee";
    const URL = "/admin/feedback/employees";
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
            "name_am" => "required|max:255",
            "name_ru" => "required|max:255",
            "name_ar" => "required|max:255",
            "active"  => "required",
            "image"   => "required|image"
        ]);

        if(!is_dir(public_path("uploads/$this->upload"))) {
            mkdir(public_path("uploads/$this->upload"), 0777);
        }
        $file = Storage::putFile($this->upload, new File($request->image), 'public');

        $employee = new Employee();
        $employee->name_en = $request->name_en;
        $employee->name_fr = $request->name_fr;
        $employee->name_ar = $request->name_ar;
        $employee->name_am = $request->name_am;
        $employee->name_ru = $request->name_ru;
        $employee->image = $file;
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
            "name_am" => "required|max:255",
            "name_ru" => "required|max:255",
            "name_ar" => "required|max:255",
            "active"  => "required",
            "image"   => (null !=$request->image) ? "image" : ""

        ]);
        if(null != $request->image) {
            if(!is_dir(public_path("uploads/$this->upload"))) {
                mkdir(public_path("uploads/$this->upload"), 777);
            }
            $file = Storage::putFile($this->upload, new File($request->image), 'public');
        }

        $employee->name_en = $request->name_en;
        $employee->name_fr = $request->name_fr;
        $employee->name_ar = $request->name_ar;
        $employee->name_am = $request->name_am;
        $employee->name_ru = $request->name_ru;
        if(isset($file)) {
            $employee->image = $file;
        }
        $employee->active  = $request->active;
        $employee->save();

        return redirect(self::URL);
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
