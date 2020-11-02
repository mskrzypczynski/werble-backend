<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventResourceCollection;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : EventResourceCollection
    {

        return (new EventResourceCollection(Event::paginate()))->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
            'event_name'                =>  '',
            'event_location'            =>  '',
            'zip_code'                  =>  '',
            'street_name'               =>  '',
            'house_number'              =>  '',
            'event_longitude'           =>  '',
            'event_latitude'            =>  '',
            'event_description'         =>  '',
            'event_datetime'            =>  '',
            //'event_is_active'           =>  '',
            //'event_visibility_level_id' =>  '',
            //'event_status_id'           =>  '',
            //'event_creator_id'          =>  '',
            //'event_type_id'             =>  '',
            ]
        );

        $event = Event::create($request->all());
        return (new EventResource($event))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return EventResource
     */
    public function show(Event $event) : EventResource
    {
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Event $event
     * @return void
     */
    public function update(Request $request,Event $event)
    {
        $request->validate(
            [
                'event_name'                =>  '',
                'event_location'            =>  '',
                'zip_code'                  =>  '',
                'street_name'               =>  '',
                'house_number'              =>  '',
                'event_longitude'           =>  '',
                'event_latitude'            =>  '',
                'event_description'         =>  '',
                'event_datetime'            =>  '',
                'event_is_active'           =>  '',
                'event_visibility_level_id' =>  '',
                'event_status_id'           =>  '',
                'event_creator_id'          =>  '',
                'event_type_id'             =>  '',
            ]
        );
        $event->update($request->all());
        Return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return void
     */
    public function destroy(Event $event)
    {
        //
    }
}
