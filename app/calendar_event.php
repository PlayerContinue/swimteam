<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use APP\Library\Objects\EventsObject;
use APP\Library\Objects\EventDataObject;
class calendar_event extends Model
{
    
    /*public $id;
    public $img;
    public $startDate;
    public $endDate;
    public $location;
    public $title;
    public $details;
    public $color;*/
    
    /**
     * Create a new event in the calendar of events
     * @param Request $request - The events
     */
    public static function createEvent(Request $request){
        $event = new calendar_event();
        $data = $request->all();
        $event->description = $data["details"];
        $event->startDate = $data["startDate"];
        $event->endDate = $data["endDate"];
        $event->location = $data["location"];
        $event->title = $data["title"];
        $event->color = $data["color"];
        $event->save();
        
    }
    //
    protected $table = 'calendar_events';
}
