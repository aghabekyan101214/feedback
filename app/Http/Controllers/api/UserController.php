<?php

namespace App\Http\Controllers\api;

use App\helpers\GenerateString;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\helpers\ValidateNullFields;
use Illuminate\Support\Facades\Hash;
use App\helpers\ResponseHelper;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        $user = User::selectRaw("name, email")->where("token", $request->bearerToken())->first();
        $data = array(
            "user" => $user
        );
        return ResponseHelper::success($data);
    }

    public function login(Request $request)
    {
        $fields = ['email', 'password'];
        ValidateNullFields::validate($request, $fields);
        $user = User::selectRaw("name, email, password, token")->where(["email" => $request->email])->first();

//        Wrong Email Provided
        if(null == $user) {
            return ResponseHelper::fail("Wrong Email", 422);
        }

//        Success Case Logged In
        if(Hash::check($request->password, $user->password)) {
            $user->token = GenerateString::generate();
            $data = array(
                "user" => $user
            );
            return ResponseHelper::success($data);
        } else {
//            Wrong Password Provided
            return ResponseHelper::fail("Wrong Password", 422);
        }
    }

    public function loginAsGuest()
    {
        $user = User::where("role", User::GUEST)->first();
        if(null == $user) {
            $user = $this->saveGuest();
        }
        $data = array(
            "user" => array(
                "token" => $user->token
            )
        );
        return ResponseHelper::success($data);
    }

    public function recoverPassword(Request $request)
    {
        $fields = ['email'];
        ValidateNullFields::validate($request, $fields);
        $user = User::where("email", $request->email)->first();
        if(null == $user) {
            return ResponseHelper::fail("Wrong Email Provided", 422);
        }
        $new_password = uniqid();
        $user->password = bcrypt($new_password);
        $user->save();

        $text = "Your New Restaurant App Password Is: $new_password";
        $email_response = $this->sendEmail($text, $request->email);
        if($email_response['code'] == 200) {
            return ResponseHelper::success(array(), false, $email_response['msg']);
        }
        return ResponseHelper::fail($email_response['msg'], $email_response['code']);
    }

    private function sendEmail($text, $email)
    {
        try{
            Mail::raw($text, function($message) use($email) {
                $message->to($email, "aa")
                    ->subject('bb');
            });
            return array(
                "msg" => "The Message Has Been Sent Successfully",
                "code" => 200
            );
        } catch (\Exception $exception) {
            \Log::info($exception);
            return array(
                "msg" => "Something Went Wrong, Please, Try Again",
                "code" => 500
            );
        }
    }

    private function saveGuest()
    {
        $user = new User();
        $user->name = "Guest";
        $user->email = "guest".time()."@gmail.com";
        $user->password = bcrypt($user->email);
        $user->role = 5;
        $user->token = GenerateString::generate();
        $user->save();

        return $user;
    }
}
