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

//    Feedback Routes

    Route::group(["prefix" => "feedback"], function() {
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

    //    End Feedback Routes

    Route::group(["prefix" => "pos"], function() {
        Route::get('/', 'pos\PosController@index');
        Route::resource('/categories', 'pos\CategoryController');
        Route::resource('/tables', 'pos\TableController');
        Route::resource('/items', 'pos\ItemController');
        Route::resource('/orders', 'pos\OrderController');
        Route::post('/orders/update/{orderId?}', 'pos\OrderController@update');
        Route::get('/edit-order/{id?}', 'pos\OrderController@editOrder');
        Route::resource('/current-orders', 'pos\CurrentOrdersController');
        Route::post('/current-orders/change-status/{orderId?}', 'pos\CurrentOrdersController@changeStatus');
    });

});
