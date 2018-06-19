<?php


namespace APP\Library\Objects;
class EventsObject {
    public $data;
    
    
    public function __construct($event){
        $this->data = $event;
    }
}

class EventDataObject {
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    public $id;
    public $img;
    public $startDate;
    public $endDate;
    public $location;
    public $title;
    public $details;

    public function __construct($newId,$newStartDate,$newEndDate,$newLocation,$newTitle,$newDetails,$newImg= "") {
        $this->id = $newId;
        $this->img = $newImg;
        $this->details = $newDetails;
        $this->startDate = $newStartDate;
        $this->endDate = $newEndDate;
        $this->location = $newLocation;
        $this->title = $newTitle;   
    }
    
    

}
?>