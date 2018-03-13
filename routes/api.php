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
    return json_encode(array(new EventsObject(new EventDataObject(1,"2017-06-08T01:47:18.439Z","2017-06-08T01:47:18.439Z","","test","test"))));    
});

Route::middleware('cors')->get('/forms',function(Request $request){

   return ""; 
    
});

Route::get('/login',function(Request $request) {
    return "";
});


class EventsObject {
    public $data;
    
    
    public function __construct($event){
        $this->data = $event;
    }
}

class EventDataObject {
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    public $id;
    public $img;
    public $startDate;
    public $endDate;
    public $location;
    public $title;
    public $details;

    public function __construct($newId,$newStartDate,$newEndDate,$newLocation,$newTitle,$newDetails,$newImg= "") {
        $this->id = $newId;
        $this->img = $newImg;
        $this->details = $newDetails;
        $this->startDate = $newStartDate;
        $this->endDate = $newEndDate;
        $this->location = $newLocation;
        $this->title = $newTitle;
        
    }
    
    

}