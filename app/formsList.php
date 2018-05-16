<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class formsList extends Model
{
    /***
     * Get the fields this form owns
     */
    public function getFields(){
       return $this->hasMany('App\form_submission_keys','form_id');
    }
    /**
     * Create a new form with a unique key and add it into the database. 
     * @param string $form_name
     * @return string -
     */
    public function createForm(string $form_name){
        
        
    }
    
     protected $table = 'form';
}
