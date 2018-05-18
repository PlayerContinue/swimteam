<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class form_submission_keys extends Model
{
   
     public function getFields(){
       return $this->hasMany('App\FormRegistration','form_data_id');
    }
     protected $table = 'form_submission_keys';
}
