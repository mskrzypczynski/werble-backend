<?php

namespace App\Http\Controllers\Api\UserActions;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventTypeResource;
use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventTypes = EventType::all();
        return EventTypeResource::collection($eventTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'event_type_name' => 'required',
            ]
        );
        $eventType = EventType::create($request->all());
        return (new EventTypeResource($eventType));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EventType $eventType)
    {
        return (new EventTypeResource($eventType));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventType $eventType)
    {
        $request->validate(
            [
                'event_type_name' => 'required',
            ]
        );
        $eventType->update($request->all());
        return (new EventTypeResource($eventType));
    }

    public function destroy($id)
    {
        EventType::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted event type'],200);
    }
}
