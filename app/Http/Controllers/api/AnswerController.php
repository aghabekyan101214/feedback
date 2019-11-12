<?php

namespace App\Http\Controllers\api;

use App\ClientAnswer;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    public function sendAnswer(Request $request)
    {
        if(empty($request->data) || null == $request->data){
            $response = array(
                "status" => "nok",
                "errors" => array(
                    "answers" => array(
                        "Answers cannot be blank."
                    )
                ),
                "data" => array(),
            );
            return response()->json($response);
        }
        DB::beginTransaction();
        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->age = $request->age;
        $client->gender = $request->gender;
        $client->visit = $request->visit;
        $client->comment = $request->comment;
        $client->save();

        foreach($request->data['answers'] as $key => $val) {
            if (isset($val['employee_id'])) {
                if (Employee::find($val['employee_id']) == null){
                    continue;
                }
            }

            $clientAnswer = new ClientAnswer();
            $clientAnswer->client_id = $client->id;
            $clientAnswer->question_id = $val->question_id;
            $clientAnswer->rate = $val->rate;
            $clientAnswer->text = $val->text ?? NULL;
            $clientAnswer->employee_id = $val->employee_id ?? NULL;
            $clientAnswer->variant_id = $val->custom_id ?? NULL;

            $clientAnswer->save();
        }
        DB::commit();
    }

    public function getLastUpdate()
    {
        $response = array(
            "status" => "nok",
            "data" => array(
                "last_update" => time(),
            ),
        );
        return response()->json($response);
    }
}
