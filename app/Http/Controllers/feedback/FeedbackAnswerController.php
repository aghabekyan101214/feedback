<?php

namespace App\Http\Controllers\feedback;

use App\Client;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\feedback\CustomAnswer;
use App\models\feedback\EmployeeRate;
use App\models\feedback\GeneralAnswer;
use App\models\feedback\RadioAnswer;
use App\models\feedback\RatingAnswer;
use Illuminate\Support\Facades\DB;

class FeedbackAnswerController extends Controller
{

    const URL = "/admin/feedback/employees";
    const VIEW = "feedback/feedback_answers";

    public function index()
    {
        $answers = GeneralAnswer::with(['clients', 'customAnswers', 'employeeRates', 'radioAnswers', 'ratingAnswer'])->get();
        dd($answers);
    }

    public function employeeAnswers()
    {
        $answers = EmployeeRate::with(["questions", "employees"])->orderBy("id", "desc")->paginate(100);
        $employeeWithRates = DB::table("employees")
            ->selectRaw("name_en, employees.id as id, ROUND(AVG(employee_rates.rate)::numeric,1) as rate ")
            ->leftJoin("employee_rates", "employee_rates.employee_id", "=", "employees.id")
            ->groupBy("employees.id", "name_en")
            ->get();

        return view(self::VIEW . ".employee", compact("answers", "employeeWithRates"));
    }
}
