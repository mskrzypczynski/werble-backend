<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventStatusController extends Controller
{
    public function index()
    {
        return (new EventStatusResource(EventStatus::all()));
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
                'event_status_name' => 'required',
            ]
        );
        $eventStatus = EventStatus::create($request->all());
        return (new EventStatusResource($eventStatus));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EventStatus $eventStatus)
    {
        return (new EventStatusResource($eventStatus));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventStatus $eventStatus)
    {
        $request->validate(
            [
                'event_status_name' => 'required',
            ]
        );
        $eventStatus->update($request->all());
        return (new EventStatusResource($eventStatus));
    }
    public function destroy($id)
    {
        //
    }
}
