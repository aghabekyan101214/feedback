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
        $general_questions = $this->getQuestions(Question::TYPES[Question::GENERAL]);
        $employee_questions = $this->getQuestions(Question::TYPES[Question::EMPLOYEE]);
        $employees = Employee::select("id", "name_en as full_name_en", "name_fr as full_name_fr", "name_ar as full_name_ar")->where("active", 1)->get();
        $custom_questions = Question::whereHas("custom_answer")->with(["custom_answer" => function($query){
            $query->select("id", "question_id", "answer_en", "answer_fr", "answer_ar");
        }])->where(["type" => Question::TYPES[Question::CUSTOM], "active" => 1])->get();
        $data = array(
            "fields" => $fields,
            "images" => $images,
            "general_questions" => $general_questions,
            "employee_questions" => $employee_questions,
            "custom_questions" => $custom_questions,
            "employees" => $employees,
            "last_update" => time()
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

    public function getLastUpdate()
    {
        $response = array(
            "status" => "ok",
            "errors" => array(),
            "data" => array(
                "last_update" => time()
            ),
        );
        return response()->json($response);
    }
}
