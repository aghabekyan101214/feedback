<?php

namespace App\Http\Controllers\api;

use App\helpers\GenerateString;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\helpers\ValidateNullFields;
use Illuminate\Support\Facades\Hash;
use App\helpers\ResponseHelper;

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
            $token = $user->createToken('access')->accessToken;
            $user->token = $token;
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
            "token" => $user->token
        );
        return ResponseHelper::success($data);
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
