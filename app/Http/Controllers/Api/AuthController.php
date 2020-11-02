<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /*public  function signup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'login' => 'required|string|unique:users|max:30',
            'email' => 'required|string|unique:users|max:50',
            'password' => 'required|string|max:64'
        ]);
//dd($request->all());
        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = new User([
                'login' => $request->login,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'api_token' => Str::random(80)]);
            $user->save();
            return redirect('api/users')->with('success', 'user singned up successfully!');
        }
    }*/


        /*
        $request = validate([
            'login' => 'required|string|unique:users|max:30',
            'email' => 'required|string|unique:users|max:50',
            'password' => 'required|string|max:64'
        ]);
    //if($errors)
        //return

        $user = new User([
            'login' => $request->login,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
    }*/

    public  function login(Request $request)
    {
        $request = validate([
            'login' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string'
        ]);

        $credentials = $request('email', 'password');

        if (!Auth::attempt($credentials))
            return response()->json(['message' => 'Unauthorized'], 401);

        $user = $request->user();
        $tokenRes = $user->createToken('Personal Access Token');
        $token = $tokenRes->api_token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenRes->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenRes->token->expires_at

            )->toDateTimeString()
        ]);
    }

         public function logout(Request $request){
             $request->user()->token()->revoke();
             return response()->json([
                 'message' => 'Successfully logged out'
             ]);
        }

        public function user(Request $request){
             return response()->json($request->user());
        }

}
