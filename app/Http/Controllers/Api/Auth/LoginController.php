<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    use IssueTokenTrait;

    private $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }


    public function login(Request $request)
    {
        $this->validate($request,
        [
            'login' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('login',$request->login)->first();

        if (!$user) {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }

        if (!Hash::check($request->password, $user->password)){
            $response = ["message" => "Password mismatch"];
            return response($response, 422);
        }

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
