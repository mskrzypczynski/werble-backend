<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make( $request->all() ,
            [
                'login' => 'unique:users|required|max:55',
                'email' =>  'unique:users|required|email',
                'password' => 'required',
                'email_verified_at' => now()
            ]
        );

        if($validator->fails())
        {
            return response(['errors' => $validator->errors()->all()],422);
        }

        $request['password'] = bcrypt($request->password);
        $request['remember_token'] = Str::random(10);

        $user = User::create($request->toArray());

        $accessToken = $user->createToken('Laravel Password Grant Client')->accessToken;


        return response(['user'=> $user, 'token' => $accessToken],200);

    }

    public function login(Request $request)
    {

        $validator = Validator::make( $request->all() ,
        [
            'login' =>  'string|required',
            'password' => 'required',
        ]
        );

        if($validator->fails())
        {
            return response(['errors' => $validator->errors()->all()],422);
        }

        $user = User::where('login',$request->login)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return redirect()->route('home.web',compact(['user','token']))->with($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }

    }


    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
