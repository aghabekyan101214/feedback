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
Route::get('/home', function () {
    return redirect("/admin");
});

Auth::routes();
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
    Route::get('/', 'HomeController@index');
    Route::resource("/users", "UserController");
//    Feedback Routes

    Route::group(["prefix" => "feedback"], function() {
        Route::resource('/questions', 'feedback\QuestionController');
        Route::resource('/employees', 'feedback\EmployeeController');
        Route::resource('/active-fields', 'feedback\ActiveFieldController');
        Route::resource('/images', 'feedback\ImageController');
        Route::resource('/answers', 'feedback\AnswerVariantController');
        Route::resource('/clients', 'feedback\ClientController');
        Route::post("/employees/change-status", "feedback\EmployeeController@change_status");
        Route::post("/questions/change-status", "feedback\QuestionController@change_status");
        Route::get("/questions/show-answers/{id}", "feedback\QuestionController@show_answer");
        Route::post("/active-fields/change-status", "feedback\ActiveFieldController@change_status");
        Route::post("/answers/change-status", "feedback\AnswerVariantController@change_status");
    });

    //    End Feedback Routes

    Route::group(["prefix" => "pos"], function() {
        Route::get('/', 'pos\PosController@index');
        Route::resource('/categories', 'pos\CategoryController');
        Route::resource('/tables', 'pos\TableController');
        Route::resource('/items', 'pos\ItemController');
        Route::resource('/orders', 'pos\OrderController');
        Route::resource('/sections', 'pos\TableSectionController');
        Route::post('/orders/update/{id?}', 'pos\OrderController@update')->middleware('checkOrderStatus');
        Route::get('/edit-order/{id?}', 'pos\OrderController@editOrder')->middleware('checkOrderStatus');
        Route::resource('/current-orders', 'pos\CurrentOrdersController');
        Route::post('/current-orders/change-status/{orderId?}', 'pos\CurrentOrdersController@changeStatus');
    });

});
