<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\Services\KeyGenerator;
use \App\Library\Response\JsonRequestResponse;
class FormController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($key,Request $request) {
        //Add Caching of Results
        $errors = "";
        $start_date = $request->query("start");
        $end_date = $request->query("end");
        if($start_date != '' && $end_date !='' && isset($start_date) && isset($end_date)){
            $results = DB::select("CALL create_temporary_form_table(?,DATE(?),DATE(?))", array($key,'2018-01-01','2018-12-12'));
        }else{
            $results = DB::select("CALL create_temporary_form_table(?,DATE(?),DATE(?))", array($key,date('Y-m-d'),date('Y-m-d')));
            $errors .= "No Dates provided. Please provide date in query as start and end";
        }
        return json_encode(new JsonRequestResponse(true,array("data"=>$results),$errors));
    }

    /**
     * Show the form for creating a new resource.
     * Creates a new form resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, KeyGenerator $key_generator) {
        //Create the Form 
        $data = $request->all();
        if (is_array($data) && !is_null($data) && !is_null($data["data"]) && !is_null($data["data"]["name"])) {
            //Create the form and key if the data is an array
            $form = \App\formsList::createForm($data["data"]["name"], $key_generator);
            \App\form_key::addKeys($form, $data["data"]["key_list"]);
        }else {
            
        }
        return json_encode(new JsonRequestResponse(true,array("key"=>$form->form_key)));
    }

    /**
     * Store a new form entry into the database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, string $formType) {
        return \App\FormRegistration::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Edit the forms keys
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
