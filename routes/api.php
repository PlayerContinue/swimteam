<?php

use Illuminate\Http\Request;
//use App\EventsObject;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the \"api\" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/jobs', function (Request $request) {
    return "hello World";
});

Route::middleware('cors')->get('/events',function (Request $request){
    return "";// json_encode(array(new EventsObject(new EventDataObject(1,"2017-06-08T01:47:18.439Z","2017-06-08T01:47:18.439Z","","test","test"))));    
});

Route::middleware('cors')->get('/forms/{form}','FormController@create');

Route::get('/login',function(Request $request) {
    return "";
});


