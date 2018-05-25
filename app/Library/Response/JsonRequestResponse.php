<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace APP\Library\Response;
/**
 * Class built for a response in json format
 */
class JsonRequestResponse {
    public $success;
    public $data;
    public $errors;
    
    public function __construct($success,$data="",$errors="") {
        $this->success = $success;
        $this->data = $data;
        $this->errors = $errors;
    }
}