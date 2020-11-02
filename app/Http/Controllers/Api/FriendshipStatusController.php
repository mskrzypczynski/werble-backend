<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FriendshipStatus;
use Illuminate\Http\Request;

class FriendshipStatusController extends Controller
{
    public function index()
    {
        return (new FriendshipStatusResource(FriendshipStatus::all()));
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
                'friendship_status_name' => 'required',
            ]
        );
        $friendshipStatus = FriendshipStatus::create($request->all());
        return (new FriendshipStatusResource($friendshipStatus));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FriendshipStatus $friendshipStatus)
    {
        return (new FriendshipStatusResource($friendshipStatus));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FriendshipStatus $friendshipStatus)
    {
        $request->validate(
            [
                'friendship_status_name' => 'required',
            ]
        );
        $friendshipStatus->update($request->all());
        return (new FriendshipStatusResource($friendshipStatus));
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
