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
    //return json_encode(App\formsList::where('form_key',"=",'S76uQyhQ3jmDBhlpZg1A4aaNojOT1tyI')->firstOrFail()->getFields()->get());
});


//TODO add middleware checking for key
Route::middleware('cors')->get('/events/{calendar}','CalendarEventController@index');// json_encode(array(new EventsObject(new EventDataObject(1,"2017-06-08T01:47:18.439Z","2017-06-08T01:47:18.439Z","","test","test"))));    

Route::middleware('cors')->post('/forms/create','FormController@create');

Route::middleware('cors')->post('/forms/{form}','FormController@store');


Route::middleware('cors')->get('/forms/data/{form_key}','FormController@index');

Route::middleware('cors')->get('/forms/data/{form_key}','FormController@index')->middleware('auth:api');//Get data from a form

Route::middleware('cors')->get('/forms/data/auth/{form_key}','FormController@index')->middleware('auth');;//Get data from a form


Route::middleware('cors')->post('/forms','FormController@store');

Route::middleware('cors')->post('/events/create','CalendarEventController@create');


Route::middleware('cors')->post('/login',"UserController@login");
Route::middleware('cors')->post('/register',"UserController@register");
Route::middleware('cors')->post('/logout',"UserController@logout");



/*Route::middleware('cors')->get('/registration', function(Request $request){
=======
Route::middleware('cors')->get('/registration', function(Request $request){
>>>>>>> parent of bba715c... Updated Multiple

    $row = 1;
     return json_encode(new wrapper(array(
         new exampleReg(
                'textbox',
                 'parent1Name',
                'Parent Name',
                '',
                true,
                 1,
                 $row,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'email1',
                'Email',
                '',
                true,
                 2,
                 $row,
                 'left',
               'email'
            ),
            new exampleReg(
                'textbox',
                 'homeAddress1',
                'Home Address',
                '',
                false,
                 1,
                 $row + 1,
                 'left'

            ),
            new exampleReg(
                'textbox',
                 'city1',
                'City',
                '',
                false,
                 1,
                 $row + 2,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'zipCode',
                'Zip Code',
                '',
                false,
                 3,
                 $row + 2,
                 'left'

            ),

            new exampleReg(
                'textbox',
                 'homePhone1',
                'Home Phone',
                '',
                true,
                 1,
                 $row + 3,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'workPhone1',
                'Work Phone',
                '',
                false,
                 2,
                 $row + 3,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'cellPhone1',
                'Cell Phone',
                '',
                false,
                 3,
                 $row + 3,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'parentName2',
                'Parent Name',
                '',
                true,
                 1,
                 $row + 4,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'email2',
                'Email',
                '',
                true,
                 2,
                 $row + 4,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'homeAddress2',
                'Home Address',
                '',
                false,
                 1,
                 $row + 5,
                 'left'

            ),
            new exampleReg(
                'textbox',
                 'homePhone2',
                'Home Phone',
                '',
                true,
                 1,
                 $row + 6,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'workPhone2',
                'Work Phone',
                '',
                false,
                 2,
                 $row + 6,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'cellPhone2',
                'Cell Phone',
                '',
                false,
                 3,
                 $row + 6,
                 'left'
            ),

            new exampleReg(
                'textbox',
                 'parent1Name',
                'Parent Name',
                '',
                true,
                 1,
                 $row + 7,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'email1',
                'Email',
                '',
                true,
                 2,
                 $row + 7,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'homeAddress1',
                'Home Address',
                '',
                false,
                 1,
                 $row + 7,
                 'left'

            ),
           
            new exampleReg(
                'textbox',
                 'city1',
                'City',
                '',
                false,
                 1,
                 $row + 8,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'zipCode',
                'Zip Code',
                '',
                false,
                 3,
                 $row + 8,
                 'left'

            ),

            new exampleReg(
                'textbox',
                 'homePhone1',
                'Home Phone',
                '',
                true,
                 1,
                 $row + 9,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'workPhone1',
                'Work Phone',
                '',
                false,
                 2,
                 $row + 9,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'cellPhone1',
                'Cell Phone',
                '',
                false,
                 3,
                 $row + 9,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'parentName2',
                'Parent Name',
                '',
                true,
                 1,
                 $row + 10,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'email2',
                'Email',
                '',
                true,
                 2,
                 $row + 10,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'homeAddress2',
                'Home Address',
                '',
                false,
                 1,
                 $row + 11,
                 'left'

            ),
            new exampleReg(
                'textbox',
                 'homePhone2',
                'Home Phone',
                '',
                true,
                 1,
                 $row + 12,
                 'left'
            ),
            new exampleReg(
                'textbox',
                 'workPhone2',
                'Work Phone',
                '',
                false,
                 2,
                 $row + 12,
                 'left'
            ),
            new exampleReg(
                'mat-textbox',
                 'cellPhone2',
                'Cell Phone',
                '',
                false,
                 3,
                 $row + 12,
                 'left'
            )
    )));
         
    
});

Route::get('/login',function(Request $request) {
    return "";
});

class wrapper {
    public $data;
      public function __construct($exampleReg){
        $this->data = $exampleReg;
    }
}

class exampleReg{
    public $controlType;
    public $key;
    public $label;            
    public $value;            
    public $order;            
    public $required;            
    public $row;
    public $labelPosition; 
    public $type;
                
    
   public function __construct($a,$b,$c,$d,$e,$f,$g,$h){
        $this->controlType = $a;
        $this->key = $b;
        $this->label = $c;
        $this->value = $d;
        $this->required = $e;
        $this->order = $f;
        $this->row = $g;
        $this->labelPostion = $h;
    }
}