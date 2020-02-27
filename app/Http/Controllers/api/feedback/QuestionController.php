<?php

namespace App\Http\Controllers\api\feedback;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;
use App\helpers\ResponseHelper;
use App\helpers\LanguageHelper;

class QuestionController extends Controller
{
    private $lang;

    public function __construct(Request $request)
    {
        $this->lang = LanguageHelper::checkLang($request->lang) ? $request->lang : "en";
    }

    public function getGeneralQuestions()
    {
        $group = Question::GENERAL;
        $rate = Question::selectRaw("id, question_$this->lang as question")->where(["group" => $group, "type" => Question::RATE, "active" => 1])->get();
        $radio = Question::selectRaw("id, question_$this->lang as question")->whereHas("variants")->with(["variants" => function($query){
            $query->selectRaw("id, answer_$this->lang as answer, question_id");
        }])->where(["group" => $group, "type" => Question::RADIO, "active" => 1])->get();
        $data = array(
            "rate" => $rate,
            "radio" => $radio
        );

        return ResponseHelper::success($data);
    }

    public function getWaiterQuestions()
    {
        $group = Question::EMPLOYEE;
        $rate = Question::selectRaw("id, question_$this->lang as question")->where(["group" => $group, "type" => Question::RATE, "active" => 1])->get();

        $data = array(
            "rate" => $rate,
        );

        return ResponseHelper::success($data);
    }

    public function getCustomQuestions()
    {
        $group = Question::CUSTOM;
        $custom = Question::selectRaw("id, question_$this->lang as question")->where(["group" => $group, "type" => Question::CUSTOM, "active" => 1])->get();
        $data = array(
            "custom" => $custom,
        );

        return ResponseHelper::success($data);
    }
}
