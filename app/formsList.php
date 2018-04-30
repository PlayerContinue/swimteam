<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class formsList extends Model
{
    /***
     * Get the fields this form owns
     */
    public function getFields(){
       return $this->hasMany('App\form_submission_keys','form_key','form_key');
    }
    
     protected $table = 'form';
}
