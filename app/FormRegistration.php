<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FormRegistration extends Model {
    const KEY = "key";
    //
    public static function store(Request $request) {
        //TODO confirm request to well-formed. 
        $data = $request->all(); //Select all incoming data 
        if (is_array($data) && !is_null($data["data"])) {
            try{
            FormRegistration::SaveData($data["data"]);
            }catch(Exception $ex){
                return "fail";
            }
        } else {
            return "Provided JSON is not an array, values must be provided as an array in the form {\"data\":{\"form\":{\"field\":\"value\", \"key\":\"key_value\"}}";
        }
    }
    
    /**
     * Go through data array and insert into database if has a key
     * @param array $data - The array data in form {\"data\":{\"form\":{\"field\":\"value\"},\"key\":\"key_value\"}
     * @return string - An error
     */
    private static function SaveData(Array $data){
        $data_array = array();
        
            $data_key = $data["form"][FormRegistration::KEY];
               $forms = formsList::where('form_key', '=', $data_key)->first();
            if(!empty($data_key) && isset($forms)){
            
            //Grab each key for storage
            foreach ($data["form"] as $key => $value) {
                
                if (FormRegistration::KEY !== $key && !is_null($key) && !is_null($value)) {
                    //TODO Add method to make sure data is safe
                    $form = new FormRegistration;
                    $form->field = $key;
                    $form->value = $value;
                    //$form->form_data_id = $forms->;
                    array_push($data_array,$form);
                }
            }
               
                $idtest = $forms->id;
                //Save Key to form_submission_keys
                $results = $forms->getFields()->save(new form_submission_keys());
                //Save Data to form_data
                $results->getFields()->saveMany($data_array);
                return "";
            }else{
                return "No key or bad key was provided. Values must be provided as an array in the form {\"data\":{\"form\":{\"field\":\"value\", \"key\":\"key_value\"}}";
            }
        
    }
    
    /**
     * Get the form that owns this field
     * @return type
     */
    public function formsList(){
        return $this->belongsTo('App\formsList','form_key','form_key');
    }
    
    public function formSubmissionKeys(){
        return $this->belongsTo('App\form_submission_keys','form_data_id','id');
    }

    protected $table = 'form_submission';

}
