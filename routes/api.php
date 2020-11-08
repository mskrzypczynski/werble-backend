<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::group(['middleware'=> ['cors','json.response' ]], function () {
    Route::post('login', [AuthController::class,'login'])->name('login.api');
    Route::post('signup', [AuthController::class,'register'])->name('register.api');
});

// Private routes
Route::group(['middleware' => ['cors','json.response', 'auth:api']], function (){
    //logout
    Route::post('logout', [AuthController::class,'logout'])->name('logout.api');
    Route::get('is_admin', function()
    {
        return Auth::guard('api')->user()->isAdmin();
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('events');
        Route::post('events/create');
        Route::get('events/{id}');

    });

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

        //admin api resources, most important
        Route::apiResource('users','Api\UserController');
        Route::apiResource('events', 'Api\EventController');
        Route::apiResource('reviews','Api\EventReviews');
        Route::apiResource('participants','Api\ParticipantController');
        Route::get('users/{id}', function ($id) {

        });
        // types and statuses
        Route::apiResource('event_statuses','Api\EventStatusController');
        Route::apiResource('event_types','Api\EventTypeController');
        Route::apiResource('friendship_statuses','Api\FriendshipStatusController');
        Route::apiResource('participant_statuses','Api\ParticipantStatusController');
    });
});
