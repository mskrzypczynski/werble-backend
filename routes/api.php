<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware'=> ['cors','json.response' ]], function () {
    Route::post('login', [AuthController::class,'login'])->name('login.api');
    Route::post('signup', [AuthController::class,'register'])->name('register.api');

});

Route::group(['middleware' =>['auth:api','admin']],function ()
{
    Route::apiResource('event_types','Api\EventTypeController');
});



Route::middleware('auth:api')->group(function (){
    Route::post('logout', [AuthController::class,'logout'])->name('logout.api');
    Route::apiResource('events', 'Api\EventController');
    Route::apiResource('friendship_status','Api\FriendshipStatusController');
    Route::apiResource('event_interest_levels','Api\EventInterestLevelController');
    Route::apiResource('event_statuses','Api\EventStatusController');
    Route::apiResource('events_participants','Api\EventParticipantController');

    Route::apiResource('users', 'Api\UserController');
    Route::apiResource('user_friends', 'Api\UserFriendController');
});


