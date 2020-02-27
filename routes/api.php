<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("/getAllData", "api\HomeController@index");
Route::get("/getLastUpdate", "api\HomeController@getLastUpdate");
Route::post("/sendAnswer", "api\AnswerController@sendAnswer");

Route::post("/login", "api\UserController@login");
Route::post("/login-guest", "api\UserController@loginAsGuest");
Route::get("/get-configuration", "api\ConfigurationController@getConfiguration");
Route::post("/recover-password", "api\UserController@recoverPassword");

Route::group(['middleware' => 'api-auth'],function(){

    Route::group(["prefix" => "pos"], function() {
        Route::get("/get-orders", "api\pos\OrderController@getOrders");
        Route::get("/get-order-list", "api\pos\OrderController@getOrderList");
        Route::get("/get-tables", "api\pos\TableController@getTables");
        Route::get("/get-categories", "api\pos\CategoryController@getCategories");
        Route::get("/get-items", "api\pos\ItemController@getItems");
        Route::post("/store-order", "api\pos\OrderController@manageStoreOrder");
        Route::post("/edit-order", "api\pos\OrderController@editOrder");
    });

    Route::group(["prefix" => "user"], function() {
        Route::get("/get-user", "api\UserController@getUser");
    });

    Route::group(["prefix" => "feedback"], function() {
        Route::get("/get-general-questions", 'api\feedback\QuestionController@getGeneralQuestions');
        Route::get("/get-waiter-questions", 'api\feedback\QuestionController@getWaiterQuestions');
        Route::get("/get-custom-questions", 'api\feedback\QuestionController@getCustomQuestions');
    });

});
