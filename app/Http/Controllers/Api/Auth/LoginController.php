<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use IssueTokenTrait;

    //Client for Passport Password Grant
    private $client;

    public function __construct()
    {
        //Laravel Passport Grant Client default id is 2
        $this->client = Client::find(2);
    }


    public function login(Request $request)
    {
        //validate request data
        $this->validate($request,
        [
            'login'     => 'required',
            'password'  => 'required'
        ]);

        //get user from db
        $user = User::where('login',$request->login)->first();

        //check if user exists
        if (!$user) {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }

        //check if hash of given password and hash in db matches
        if (!Hash::check($request->password, $user->password)){
            $response = ["message" => "Password mismatch"];
            return response($response, 422);
        }

        //get access,refresh tokens for user from oauth/token
        return $this->issueToken($request,'password');
    }



    public function refresh(Request $request)
    {
        $this->validate($request, [
            'refresh_token' => 'required'
        ]);

        return $this->issueToken($request,'refresh_token');
    }


    public function logout(Request $request)
    {
        $accessToken = Auth::user()->token();
        $refreshToken = DB::table('oauth_refresh_tokens')
            ->where('access_token_id',$accessToken->id)
            ->update(['revoked' => true]);

        $accessToken->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response()->json($response,200);
    }
}
