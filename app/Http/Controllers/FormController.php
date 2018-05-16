<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\Services\KeyGenerator;

class FormController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($key, $start_date = "", $end_date = "") {
        //Add Caching of Results
        $results = DB::select("CALL create_temporary_form_table(?)",array($key));
        return $results;
    }

    /**
     * Show the form for creating a new resource.
     * Creates a new form resource.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, KeyGenerator $generator) {
        //\App\formsList::createForm("test");
        return $generator->generateRandomString(32);
        
    }

    /**
     * Store a newly created resource in storage.
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
     * Show the form for editing the specified resource.
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
