<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FormRegistration extends Model {

    //
    public static function store(Request $request) {
        
        $data = $request->all(); //Select all incoming data 
        if (is_array($data) && !is_null($data["data"]) && !is_null($data["data"]["key"])) {
            try{
            FormRegistration::SaveData($data);
            }catch(Exception $ex){
                return "fail";
            }
        } else {
            return "Provided JSON is not an array, values must be provided as an array in the form {\"data\":{\"form\":{\"field\":\"value\"},\"key\":\"key_value\"}";
        }
    }
    
    /**
     * Go through data array and insert into database if has a key
     * @param array $data - The array data in form {\"data\":{\"form\":{\"field\":\"value\"},\"key\":\"key_value\"}
     * @return string - An error
     */
    private static function SaveData(Array $data){
        $data_array = array();
            $data_key = $data["data"]["key"];
               $forms = formsList::where('form_key', '=', $data_key)->first();
            if(!empty($data_key) && isset($forms)){
           
            foreach ($data["data"]["form"] as $key => $value) {
                
                if (!is_null($key) && !is_null($value)) {
                    //TODO Add method to make sure data is safe
                    $form = new FormRegistration;
                    $form->field = $key;
                    $form->value = $value;
                    $form->form_data_id = 1;
                    array_push($data_array,$form);
                }
            }
               
            //TODO add update to form_combine value
            
            
                $forms->getFields()->saveMany($data_array);
                return "";
            }else{
                return "No key or bad key was provided. Values must be provided as an array in the form {\"data\":{\"form\":{\"field\":\"value\"},\"key\":\"key_value\"}";
            }
        
    }
    
    /**
     * Get the form that owns this field
     * @return type
     */
    public function formsList(){
        return $this->belongsTo('App\formsList','form_key','form_key');
    }

    protected $table = 'form_data';

}
