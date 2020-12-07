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
    private function calculateDistanceBetweenTwoAddresses($lat1, $lng1, $lat2, $lng2){
        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);

        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);

        $delta_lat = $lat2 - $lat1;
        $delta_lng = $lng2 - $lng1;

        $hav_lat = (sin($delta_lat / 2))**2;
        $hav_lng = (sin($delta_lng / 2))**2;

        $distance = 2 * asin(sqrt($hav_lat + cos($lat1) * cos($lat2) * $hav_lng));

        $distance = 6371*$distance;
        // If you want calculate the distance in miles instead of kilometers, replace 6371 with 3959.

        return $distance;
    }


    public function createEvent(Request $request){
        $user = $request->user();

        $toCheck = [
                'name' => 'required',
                'location' => 'required',
                'description' => 'nullable',
                'datetime' => 'required',
                'longitude' => 'nullable',
                'latitude' => 'nullable'
        ];

        $toUpdate = [];

        foreach ($toCheck as $key => $value)  if ($request["$key"]) $toUpdate[$key] = $value;
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
            return response()->json(403,'You dont have rights to do this');

        $event -> delete();

        return response()->json(200,'Event deleted');
    }

    public function getUserEvents(Request $request){
        $user = $request->user();
        $events = $user->events()->where('is_active',1)->get();
        return EventResource::collection($events);
    }

    public function getLocalEvents(Request $request){
        $user = $request->user();
        $userLat = $user->latitude;
        $userLng = $user->longitude;

        $events = Event::all();
        $distance = 10; // kilometers

        $markers = collect($events)->map(function($event) use ($userLat,$userLng) {
            $distance = $this->calculateDistanceBetweenTwoAddresses($event->latitude, $event->longitude, $userLat, $userLng);
            $event['distance'] = sprintf("%0.3f",$distance);

            return $event;
        });
        //dd($markers);
        $events = $markers->where('distance','<', $distance);
        return EventResource::collection($events);
    }

    public function getAllEvents(Request $request){
        $events = Event::all();
        return EventResource::collection($events);
    }

}
