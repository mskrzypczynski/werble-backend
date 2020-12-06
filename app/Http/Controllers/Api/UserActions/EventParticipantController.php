<?php

namespace App\Http\Controllers\Api\UserActions;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventParticipantResource;
use App\Http\Resources\EventParticipantResourceCollection;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\EventParticipant;

use Illuminate\Http\Request;

class EventParticipantController extends Controller
{
   public function joinEvent(Request $request){
       $eventId = $request->event_id;
       $user = $request->user();

       $event = Event::where('event_id',$eventId)->first();

       if(!$event)
           return response()->json(404,['message'=>'Event not found']);

       $eventParticipant = new EventParticipant;
       $eventParticipant ->event_id = $eventId;
       $eventParticipant ->user_id = $user->id;
       $eventParticipant ->is_creator = ($event->event_creator_id === $user->user_id);
       $eventParticipant ->participant_status_id = $request->participant_status_id;

       $eventParticipant -> save();
       return response()->json(200,['message' => 'Successfully joined event']);
   }

    public function getUserParticipatingEvents(Request $request){
       $user = $request->user();
       $events =[];
       $participants = $user->participants()->get();
       foreach ($participants as $participant)
       {
         array_push($events,$participant->event()->first());
       }

        return EventResource::collection($events);
    }


}
