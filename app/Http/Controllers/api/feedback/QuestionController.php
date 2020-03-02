<?php

namespace App\Http\Controllers\api\feedback;

use App\Client;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\helpers\ResponseHelper;
use App\helpers\LanguageHelper;
use App\models\feedback\CustomAnswer;
use App\models\feedback\EmployeeRate;
use App\models\feedback\GeneralAnswer;
use App\models\feedback\RadioAnswer;
use App\models\feedback\RatingAnswer;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    private $lang;

    public function __construct(Request $request)
    {
        $this->lang = LanguageHelper::checkLang($request->lang) ? $request->lang : "en";
    }

    public function getQuestions()
    {
        $genQuestions = $this->getGeneralQuestions();
        $waiterQuestions = $this->getWaiterQuestions();
        $customQuestions = $this->getCustomQuestions();
        $employees = $this->getEmployees();

        $data = array(
            "general_questions" => $genQuestions,
            "waiter_questions" => $waiterQuestions,
            "custom_questions" => $customQuestions,
            "emmployees" => $employees
        );

        return ResponseHelper::success($data);
    }

    private function getGeneralQuestions()
    {
        $group = Question::GENERAL;
        $rate = Question::selectRaw("id, question_$this->lang as question")->where(["group" => $group, "type" => Question::RATE, "active" => 1])->get();
        $radio = Question::selectRaw("id, question_$this->lang as question")->whereHas("variants")->with(["variants" => function ($query) {
            $query->selectRaw("id, answer_$this->lang as answer, question_id");
        }])->where(["group" => $group, "type" => Question::RADIO, "active" => 1])->get();

        return array(
            "rate" => $rate,
            "radio" => $radio
        );
    }

    private function getWaiterQuestions()
    {
        $group = Question::EMPLOYEE;
        $rate = Question::selectRaw("id, question_$this->lang as question")->where(["group" => $group, "type" => Question::RATE, "active" => 1])->get();

        $data = array(
            "rate" => $rate,
        );

        return $data;
    }

    private function getCustomQuestions()
    {
        $group = Question::CUSTOM;
        $custom = Question::selectRaw("id, question_$this->lang as question")->where(["group" => $group, "type" => Question::CUSTOM, "active" => 1])->get();
        $data = array(
            "custom" => $custom,
        );

        return $data;
    }

    private function getEmployees()
    {
        $url = Url::to('/');
        $employees = Employee::selectRaw("id, name_$this->lang as name, concat('$url/uploads/', image) as image")->get();
        return $employees;
    }

    public function storeAnswer(Request $request)
    {
        $bodyContent = json_decode($request->getContent());
        if(empty($bodyContent)) return ResponseHelper::fail("Empty Data!!", 422);

        $general = $bodyContent->general_questions ?? null;
        $waiter = $bodyContent->waiter_questions ?? null;
        $custom = $bodyContent->custom_questions ?? null;
        $client = $bodyContent->client ?? null;
        //Lets create a new general answer
        $gen_answer = new GeneralAnswer();
        $gen_answer->save();

        $this->storeGeneralRating($general, $gen_answer->id);
        $this->storeWaiterRating($waiter, $gen_answer->id);
        $this->storeCustomAnswers($custom, $gen_answer->id);
        $client_id = $this->storeClient($client);
        if(null != $client_id) {
            $gen_answer = GeneralAnswer::find($gen_answer->id);
            $gen_answer->client_id = $client_id;
            $gen_answer->save();
        }
        return ResponseHelper::success(array(), null, "You Have Successfully Rated");
    }

    private function storeGeneralRating($data, $gen_id)
    {
        DB::beginTransaction();
        $rates = $data->rate ?? [];
        foreach ($rates as $rate ) {
            $ratingAnswer = new RatingAnswer();
            $ratingAnswer->question_id = $rate->question_id;
            $ratingAnswer->rate = $rate->rate;
            $ratingAnswer->general_answer_id = $gen_id;
            $ratingAnswer->save();
        }
        DB::commit();

        $radio = $data->radio ?? [];

        DB::beginTransaction();
        foreach ($radio as $r ) {
            $radioAnswer = new RadioAnswer();
            $radioAnswer->question_id = $r->question_id;
            $radioAnswer->answer_variant_id = $r->answer_id;
            $radioAnswer->general_answer_id = $gen_id;
            $radioAnswer->save();
        }
        DB::commit();
    }

    private function storeWaiterRating($data, $gen_id)
    {
        DB::beginTransaction();
        $rates = $data->rate ?? [];
        foreach ($rates as $rate ) {
            $employeeRate = new EmployeeRate();
            $employeeRate->question_id = $rate->question_id;
            $employeeRate->employee_id = $rate->waiter_id;
            $employeeRate->rate = $rate->rate;
            $employeeRate->general_answer_id = $gen_id;
            $employeeRate->save();
        }
        DB::commit();
    }

    private function storeCustomAnswers($data, $gen_id)
    {
        DB::beginTransaction();
        $customs = $data->custom ?? [];
        foreach ($customs as $custom ) {
            $employeeRate = new CustomAnswer();
            $employeeRate->question_id = $custom->question_id;
            $employeeRate->text = $custom->text;
            $employeeRate->general_answer_id = $gen_id;
            $employeeRate->save();
        }
        DB::commit();
    }

    private function storeClient($data)
    {

        if(null == $data) return null;
        $client = new Client();
        $client->name = $data->name ?? null;
        $client->email = $data->email ?? null;
        $client->phone = $data->phone ?? null;
        $client->save();
        return $client->id;
    }
}
