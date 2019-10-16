<?php

namespace App\Http\Controllers\api;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use App\ActiveField;
use Illuminate\Support\Facades\URL;
use App\Question;

class HomeController extends Controller
{
    public function index()
    {
        $fields = ActiveField::select("field_name", "required")->where("active", 1)->get();
        $images = Image::selectRaw('CONCAT("'.URL::to('/').'/uploads/", image) as image')->get();
        $general_questions = $this->getQuestions(Question::GENERAL);
        $employee_questions = $this->getQuestions(Question::EMPLOYEE);
        $employees = Employee::select("id", "name_en as full_name_en", "name_fr as full_name_fr", "name_ar as full_name_ar")->where("active", 1)->get();
        $data = array(
            "fields" => $fields,
            "images" => $images,
            "general_questions" => $general_questions,
            "employee_questions" => $employee_questions,
            "employees" => $employees
        );
        $response = array(
            "status" => "ok",
            "errors" => array(),
            "data" => $data,
        );
        return response()->json($response);
    }

    private function getQuestions($type)
    {
        return Question::select("id", "question_en", "question_fr", "question_ar")->where(["active" => 1, "type" => $type])->get();
    }
}
