<?php

namespace App\Http\Controllers\Api\UserActions;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateUserPosition(Request $request){
        $user = $request->user();
        $this->validate($request,[
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $user->longitude = $request->longitude;
        $user->latitude = $request->latitude;

        $user->save();
        return response()->json(['message' => 'Successfully updated localization'],200);
    }


    public function getAuthenticatedUserProfile(Request $request){
        $user = $request->user();
        return (new ProfileResource($user));
    }

    public function getUserProfile(Request $request, $id){
        $user = User::findOrFail($id);
        return (new ProfileResource($user));
    }

    public function editAuthenticatedUserProfile(Request $request){
        $user = $request->user();

        $toCheck = [
            [
                'email' => 'nullable',
                'first_name' => 'nullable',
                'last_name' => 'nullable',
                'birt_date' => 'nullable',
                'description' => 'nullable',
            ]
        ];
        $toUpdate = [];


        foreach ($toCheck as $key => $value) if ($request->has($key)) $toUpdate[$key] = $value;

        // validate sent data
        $this->validate($request,$toUpdate);

        // update only sent attr
        foreach ($toUpdate as $key => $value) $user[$key] = $request[$key];

        $user->save();
        return (new EventResource($user))->response()->setStatusCode(200);
    }


}
