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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['middleware'=> ['cors','json.response' ]], function () {
    Route::post('login', [AuthController::class,'login'])->name('login.api');
    Route::post('signup', [AuthController::class,'register'])->name('register.api');

});

Route::middleware('auth:api')->group(function (){
    Route::post('logout', [AuthController::class,'logout'])->name('logout.api');
    Route::apiResource('events', 'Api\EventController');
});

/*
Route::apiResource('friendship_status','Api\FriendshipStatusController');
Route::apiResource('event_interest_levels','Api\EventInterestLevelController');
Route::apiResource('event_statuses','Api\EventStatusController');
Route::apiResource('event_types','Api\EventTypeController');
Route::apiResource('events','Api\EventController');
Route::apiResource('events_participants','Api\EventParticipantController');
//ten niżej nie działa, zwraca participantów ale z różnych wydarzeń????????????
//Route::apiResource('events.participants','Api\EventParticipantController')->shallow();
//UserFriendController?
Route::apiResource('events.reviews', 'Api\UserFriendController')->shallow();
Route::apiResource('users', 'Api\UserController');
Route::apiResource('user_friends', 'Api\UserFriendController');
;
//Route::get('/user/{user}',[\App\Http\Controllers\Api\UserController::class, 'show']);
/*
Route::prefix('user')->group( function (){
    Route::post('login', 'Api\LoginController@login');
});
*/
