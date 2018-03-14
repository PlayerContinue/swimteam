<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class FormRegistration extends Model
{
    //
    public static function store(Request $request){
        $form = new FormRegistration;
        $form->name = $request->name . "s";
        $form->address = $request->address . "s";
        //$form->save();
    }
    
    protected $table = 'form_registrations';
}
