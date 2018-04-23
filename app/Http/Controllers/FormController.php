<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class FormController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($key, $start_date = "", $end_date = "") {
        //Select data from the source
        $results = DB::table('form_registrations')->
                join('form_list_keys', function($join) {
                    $join->on(
                            [
                                ['form_list_keys.key', '=', 'form_registrations.field'],
                                ["form_list_keys.form_list_key", '=', 'form_registrations.form_list_key']
                    ]);
                })->
                SELECT("form_list_keys.form_list_key", 'form_registrations.field', 'form_registrations.value','form_registrations.created_at')
                ->WHERE('form_registrations.form_list_key', '=', $key)->orderBy('form_registrations.created_at')
                ->get();
        return $results;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, string $formType) {
        
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
