<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventParticipantResource;
use App\Http\Resources\EventParticipantResourceCollection;
use App\Models\EventParticipant;
use Illuminate\Http\Request;

class EventParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : EventParticipantResourceCollection
    {
        return (new EventParticipantResourceCollection(EventParticipant::paginate()));
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
                'is_creator' => '',
                'user_id' => '',
                'event_id' => '',
                'event_interest_level_id' => '',
            ]
        );

        $eventParticipant = EventParticipant::create($request->all());
        return (new EventParticipant($eventParticipant));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EventParticipant $eventParticipant) : EventParticipant
    {
        return (new EventParticipantResource($eventParticipant));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventParticipant $eventParticipant) : EventParticipant
    {
        $request->validate(
            [
                'is_creator' => '',
                'user_id' => '',
                'event_id' => '',
                'event_interest_level_id' => '',
            ]
        );
        $eventParticipant->update($request->all());
        return (new EventParticipantResource($eventParticipant));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
