<?php

namespace App\Http\Controllers\Api\UserActions;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function updateUserPosition(Request $request){
        $user = $request->user();
        $this->validate($request,[
            'latitude'  => 'required',
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
                    'email'     => ['required',
                                    'unique:users',
                                    'email'
                                    ],
                    'first_name'    => 'nullable',
                    'last_name'     => 'nullable',
                    'birth_date'    => 'nullable|date|after:1900-01-01',
                    'description'   => 'nullable|regex:/^[a-zA-Z0-9 ]{0,280}$/'
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

    public function updatePassword(Request $request){
        $user = $request->user();

        $this->validate($request,[
            'password' => ['required',
                'min:8',
                'max:64',
                'regex:/^[a-zA-Z0-9]{8,64}$/',
//                'confirmed'
            ]
            ]);

        $user['password'] = Hash::make($request->password);

        $user->update();
        return (new EventResource($user));
    }

    public function deactivateAuthenticatedUserProfile(Request $request){
        $user = $request->user();
        $user->delete();
        return response()->json(['message' => 'You have deactivated your account!'],200);
    }


}
