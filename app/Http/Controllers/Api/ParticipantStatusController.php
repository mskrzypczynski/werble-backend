<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipantStatusResource;
use App\Models\ParticipantStatus;
use Illuminate\Http\Request;

class ParticipantStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ParticipantStatusResource(ParticipantStatus::all()));
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
                'participant_status_name' => 'required',
            ]
        );
        $participantStatus = ParticipantStatus::create($request->all());
        return (new ParticipantStatusResource($participantStatus));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ParticipantStatus $participantStatus)
    {
        return (new ParticipantStatusResource($participantStatus));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParticipantStatus $participantStatus)
    {
        $request->validate(
            [
                'participant_status_name' => 'required',
            ]
        );
        $participantStatus->update($request->all());
        return (new ParticipantStatusResource($participantStatus));
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
