<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FormRegistration extends Model {

    //
    public static function store(Request $request) {
        
        $data = $request->all();
        if (is_array($data) && !is_null($data["data"]) && !is_null($data["data"]["key"])) {
            try{
            $this->SaveData($data);
            }catch(Exception $ex){
                
            }
        } else {
            return "Provided JSON is not an array, values must be provided as an array in the form {\"data\":{\"form\":{\"field\":\"value\"}}";
        }
    }
    
    private function SaveData(Array $data){
        $data_array = array();
            $data_key = $data["data"]["key"];
        
            foreach ($data["data"]["form"] as $key => $value) {
                
                if (!is_null($key) && !is_null($value)) {
                    $form = new FormRegistration;
                    $form->field = $key;
                    $form->value = $value;
                    array_push($data_array,$form);
                }
            }
            $forms = formsList::where('form_key', '=', $data_key)->firstOrFail();
            $forms->getFields()->saveMany($data_array);
        
    }
    
    /**
     * Get the form that owns this field
     * @return type
     */
    public function formsList(){
        return $this->belongsTo('App\formsList','form_key','form_list_key');
    }

    protected $table = 'form_registrations';

}
