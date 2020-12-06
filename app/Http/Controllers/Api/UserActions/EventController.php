<?php

namespace App\Http\Controllers\Api\UserActions;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventResourceCollection;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EventController extends Controller
{
    public function createEvent(Request $request){
        $user = $request->user();

        $toCheck = [
            [
                'name' => 'required',
                'location' => 'required',
                'description' => 'nullable',
                'datetime' => 'required',
                'longitude' => 'nullable',
                'latitude' => 'nullable'
            ]
        ];
        $toUpdate = [];


        foreach ($toCheck as $key => $value) if ($request->has($key)) $toUpdate[$key] = $value;

        // validate sent data
        $this->validate($request,$toUpdate);

        // update only sent attr
        $event = new Event;
        foreach ($toUpdate as $key => $value) $event[$key] = $request[$key];
        $event ->event_creator_id = $user->user_id;
        $event->save();

        $response = ['message' => 'You have created event!'];
        return response()->json($response,200);
    }

    public function editEvent(Request $request){
        $user = $request->user();
        $event = Event::where('event_id',$request->event_id)->firstOrFail();

        if(!$user->user_id === $event->event_creator_id )
            return response()->json(403,'You dont have right to do this');

        // model attrs to change sent in request, check if they exist
        $toCheck = [
            'name' => 'required',
            'location' => 'required',
            'description' => 'nullable',
            'datetime' => 'nullable'
        ];
        $toUpdate = [];


        foreach ($toCheck as $key => $value) if ($request->has($key)) $toUpdate[$key] = $value;

        // validate sent data
        $this->validate($request,$toUpdate);

        // update only sent attr
        foreach ($toUpdate as $key => $value) $event[$key] = $request[$key];

        $event->save();
        return (new EventResource($event))->response()->setStatusCode(200);
    }

    public function deleteEvent(Request $request){
        $user = $request->user();
        $event = Event::where('event_id',$request->event_id)->firstOrFail();

        if(!$user->user_id === $event->event_creator_id )
            return response()->json(403,'You dont have right to do this');

        $event -> delete();

        return response()->json(200,'Event deleted');
    }

    public function getUserEvents(Request $request){
        $user = $request->user();
        $events = $user->events()->where('is_active',1)->get();
        return EventResource::collection($events);
    }

}
