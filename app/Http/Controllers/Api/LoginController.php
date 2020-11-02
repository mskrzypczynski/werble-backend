<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class LoginController extends Controller
{

    /*public function login(Request $request){
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if(!Auth::attempt($login)){
            return response(['message' => 'Nieudane logowanie!']);
        }
        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response(['user' => Auth::user(), 'access_token' => $accessToken]);
    }*/
    /*
        public function login( Request $request ) {

            $login = $request->only('login','password');

            if ( !Auth::attempt( $login )) {
                return response( ['message' => 'Invalid login credentials.'] );
            }
            $user = $request->user();

            if ($user) { // Check if we have users in the database
                $accessToken = $user->createToken('authToken')->accessToken;
                return response(['user' => Auth::user(), 'access_token' => $accessToken]);
            } else {
                return response( ['message' => 'No user found in the database.'] );
            }
        }
    }
    */

}
