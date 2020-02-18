<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\helpers\GenerateString;

class UserController extends Controller
{

//    Path To the View Folder
    const FOLDER = "users";

//    Resource Title
    const TITLE = "Users";

//    Resource Route
    const ROUTE = "/admin/users";

//    File Upload Folder in public/uploads
    const UPLOAD = "users";

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $users = User::where("role", "!=", 1)->get();
        $roles = User::ROLES;
        return view(self::FOLDER . ".index", compact("title", "route", "users", "roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $roles = User::ROLES;
        $action = "Create";
        return view(self::FOLDER . ".create", compact("title", "route", "users", "roles", "action"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100|unique:users',
            'password' => 'required|max:100|min:6',
            'role' => 'required|integer'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->token = GenerateString::generate();
        $user->save();
        return redirect(self::ROUTE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $user
     */
    public function edit(User $user)
    {
        $title = self::TITLE;
        $route = self::ROUTE;
        $roles = User::ROLES;
        $action = "Update";
        return view(self::FOLDER . ".create", compact("title", "route", "users", "roles", "action", "user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => $user->email == $request->email ? 'required|max:100' : 'required|max:100|unique:users',
            'password' => null != $request->password ? 'max:100|min:6' : "",
            'role' => 'required|integer'
        ]);

        $user->name = $request->name;
        if($user->email != $request->email) {
            $user->email = $request->email;
        }
        if (null != $request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->save();
        return redirect(self::ROUTE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(self::ROUTE);
    }
}
