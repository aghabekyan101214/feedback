<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("/admin");
});

Auth::routes();
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
    Route::get('/', 'HomeController@index');
    Route::resource('/questions', 'QuestionController');
    Route::resource('/employees', 'EmployeeController');
    Route::resource('/active-fields', 'ActiveFieldController');
    Route::resource('/images', 'ImageController');
    Route::resource('/answers', 'AnswerVariantController');
    Route::resource('/clients', 'ClientController');
    Route::post("/employees/change-status", "EmployeeController@change_status");
    Route::post("/questions/change-status", "QuestionController@change_status");
    Route::get("/questions/show-answers/{id}", "QuestionController@show_answer");
    Route::post("/active-fields/change-status", "ActiveFieldController@change_status");
    Route::post("/answers/change-status", "AnswerVariantController@change_status");
});
