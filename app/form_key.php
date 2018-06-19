<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class form_key extends Model
{
    
     /**
     * Store multiple form values
     * @param number $id
     * @param array $listOfKeys
     */
    public static function addKeys(formsList $formId,array $listOfKeys){
        
            $keyList = array();
            forEach($listOfKeys as $key){
                $keyData = new form_key;
                $keyData->key = $key;
                array_push($keyList,$keyData);
            }
            
            $results = $formId->getFormKeyFields()->saveMany($keyList);
        
    }
    
    /**
     * Replace the current list of keys with a new one
     * @param type $formsList
     * @param array $listOfKeys
     */
    public static function replaceKeys(number $formId, array $listOfKeys){
        $forms = formsList::where('form_key','=',$formId)->first();
        
        if(isset($forms)){
            
        }
    }
    
     public function formsList(){
        return $this->belongsTo('App\formsList','id','form_id');
    }
    
    protected $table = "form_keys";
}
