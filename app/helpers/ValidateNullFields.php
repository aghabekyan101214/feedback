<?php


namespace App\helpers;


use Illuminate\Http\Request;

final class ValidateNullFields
{
    public static function validate(Request $request, $fields)
    {
        foreach ($fields as $field) {
            if(null == $request->$field) {
                $resp = array(
                    "message" => "Please, fill in ` $field ` field",
                    "status" => false,
                    "data" => array()
                );
               response()->json($resp, 422)->send();
               exit();
            }
        }
    }
}
