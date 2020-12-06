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

    // Client for Passport Password Grant
    private $client;

    public function __construct()
    {
        // Laravel Passport Grant Client default id is 2
        $this->client = Client::find(2);
    }


    public function login(Request $request)
    {
        // check if password grant client exists
        if(!$this->client) return response()->json('Password grant client not found', 422);
        // validate request data
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
            return response()->json($response, 422);
        }

        //check if hash of given password and hash in db matches
        if (!Hash::check($request->password, $user->password)){
            $response = ["message" => "Given password doesn't match"];
            return response()->json($response, 422);
        }

        //get access,refresh tokens for user from oauth/token
        return $this->issueToken($request,'password');
    }



    public function refresh(Request $request)
    {
        // check if password grant client exists
        if(!$this->client) return response()->json('Password grant client not found', 422);

        $this->validate($request, [
            'refresh_token' => 'required'
        ]);

        return $this->issueToken($request,'refresh_token');
    }


    public function logout(Request $request)
    {
        $accessToken = Auth::guard('api')->user()->token();
        $refreshToken = DB::table('oauth_refresh_tokens')
            ->where('access_token_id',$accessToken->id)
            ->update(['revoked' => true]);

        $accessToken->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response()->json($response,200);
    }

    public function logoutAll(Request  $request){
        $user = $request->user();

        // Revoke all of user's access tokens
        $accessTokens = DB::table('oauth_access_tokens')
            ->where('user_id',$user->user_id);
        $accessTokens->update(['revoked'=>true]);


        // Revoke all of user's refresh tokens
        foreach ($accessTokens->get() as $accessToken)
        {
            $refreshToken = DB::table('oauth_refresh_tokens')
                ->where('access_token_id',$accessToken->id);
            $refreshToken->update(['revoked' => true]);
       }

        $response = ['message' => 'You have been successfully logged out from all devices!'];
        return response()->json($response,200);
    }

}
