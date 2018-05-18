<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Library\Services\KeyGenerator;

class formsList extends Model
{
    /***
     * Get the fields this form owns
     */
    public function getFields(){
       return $this->hasMany('App\form_submission_keys','form_id');
    }
    
    public function getFormKeyFields(){
       return $this->hasMany('App\form_submission_keys','form_id');
    }
    /**
     * Create a new form with a unique key and add it into the database. 
     * @param string $form_name
     * @return formsList - The formsList that was created
     */
    public static function createForm(string $form_name, KeyGenerator $generator){
       
        if(!empty($form_name)){
            $generatedKey = $generator->generateRandomString(32);
            //Add check for key already generated
            $form = new formsList();
            $form->name = $form_name;
            $form->form_key = $generatedKey;
            $form->save();
            return $form;
        }else{
            return false;
        }
        
        
    }
    
     protected $table = 'form';
}
