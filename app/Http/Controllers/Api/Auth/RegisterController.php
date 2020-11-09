<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }

    public function register(Request $request)
    {

        $this->validate($request,
            [
                'login' => 'required|unique:users',
                'email' => 'required|unique:users',
                'password' => 'required|confirmed'
             ]
        );

        $password = $request->password;
        $request['password'] = Hash::make($request->password);
        $user = User::create($request->all());


        $params = [
            'grant_type' => "password",
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $request->login,
            'password' => $password,
            'scope' => '*'
        ];

        $request->request->add($params);

        //dd($request);
        $proxy = Request::create(
            'oauth/token',
            'POST');

        return Route::dispatch($proxy);
    }
}
