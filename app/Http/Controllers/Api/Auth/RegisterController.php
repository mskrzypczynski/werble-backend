<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use IssueTokenTrait;

    private $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }

    //function handling user registration
    public function register(Request $request)
    {
        // check if password grant client exists
        if(!$this->client) return response()->json('Password grant client not found', 422);

        //validate data given at register or return errors
        $this->validate($request,
            [
                'login'     => 'required|unique:users',
                'email'     => ['required',
                                'unique:users',
                                'email'
                                ],
                'password'  =>  'required|confirmed|min:8|max:64|regex:/^[a-zA-Z0-9]{8,64}$/'
             ]
        );

        //create new user with validated data
        $user = User::create(
            ['login' => $request->login,
             'email' => $request->email,
             'password' => Hash::make($request->password)
            ]
        );

        //remove email and password confirmation from request
        $request->request->remove('password_confirmation');
        $request->request->remove('email');

        //get access,refresh tokens for user from oauth/token
        return $this->issueToken($request,'password');
    }
}
