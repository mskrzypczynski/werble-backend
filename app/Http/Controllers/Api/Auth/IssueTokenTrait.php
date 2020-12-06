<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

trait IssueTokenTrait{

    public function issueToken(Request $request, $grantType, $scope = "*"){



        //List of required parameters for Laravel Password Grant request
        $params = [
            'grant_type'    => $grantType,
            'client_id'     => $this->client->id,
            'client_secret' => $this->client->secret,
            'scope'         => $scope
        ];

        if($grantType === 'password')
        {
            $params['username'] = $request->login;
            $params['password'] = $request->password;
        }

        if($grantType === 'refresh_token')
        {
            $params['refresh_token'] = $request->refresh_token;
        }


        $request->request->add($params);

        $proxy = Request::create(
            'oauth/token',
            'POST');

        return Route::dispatch($proxy);
    }
}
