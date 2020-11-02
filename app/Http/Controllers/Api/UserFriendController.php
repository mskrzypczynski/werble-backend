<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserFriendResource;
use App\Http\Resources\UserFriendResourceCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserFriend;
use Illuminate\Http\Request;

class UserFriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserFriendResourceCollection
     */
    public function index(): UserFriendResourceCollection
    {
        return new UserFriendResourceCollection(UserFriend::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return UserFriendResource
     */
    public function store(Request $request)
    {
        $userfriend = UserFriend::create($request->all());
        return new UserFriendResource($userfriend);
    }

    /**
     * Display the specified resource.
     *
     * @param $userFriend
     * @return UserFriendResource
     */
    public function show(UserFriend $userFriend): UserFriendResource
    {
        return new UserFriendResource($userFriend);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserFriend $userFriend
     * @param Request $request
     * @return void
     */
    public function update(UserFriend $userFriend, Request $request): UserFriendResource
    {
        $userFriend->update($request->all());

        return new UserFriendResource($userFriend);
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
