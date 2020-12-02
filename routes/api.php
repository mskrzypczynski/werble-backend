<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
Route::apiResource('events','Api\EventController');
Route::apiResource('users','Api\UserController');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::group(['middleware'=> ['cors','json.response' ]], function () {
    Route::post('register', [RegisterController::class,'register'])->name('register.api');
    Route::post('login', [LoginController::class,'login'])->name('login.api');
});

// Private routes
Route::group(['middleware' => ['cors','json.response', 'auth:api']], function (){
    //logout
    Route::post('logout', [LoginController::class,'logout'])->name('logout.api');
    Route::post('refresh',[LoginController::class,'refresh'])->name('refresh.api');

    Route::get('is_admin', function()
    {
        return Auth::guard('api')->user()->isAdmin();
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('events',[\App\Http\Controllers\Api\UserController::class,'userEvents']);
        Route::post('events/create',[\App\Http\Controllers\Api\UserController::class,'createEvent']);
        Route::post('events/review/create',[\App\Http\Controllers\Api\UserController::class,'createReview']);
        Route::get('events/{id}');
        Route::get('participant',[\App\Http\Controllers\Api\UserController::class,'userParticipant']);
        //Route::get('friends',[\App\Http\Controllers\Api\UserFriendController::class,'userFriends']);
        Route::put('{id}',[\App\Http\Controllers\Api\UserController::class,'update']);

    });

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

        //admin api resources, most important
        //Route::apiResource('users','Api\UserController');
        //Route::apiResource('events', 'Api\EventController');
        //Route::apiResource('reviews','Api\EventReviews');
        //Route::apiResource('participants','Api\ParticipantController');
        Route::get('users/{id}', function ($id) {

        });
        // types and statuses
        Route::apiResource('event_statuses','Api\EventStatusController');
        Route::apiResource('event_types','Api\EventTypeController');
        Route::apiResource('friendship_statuses','Api\FriendshipStatusController');
        Route::apiResource('participant_statuses','Api\ParticipantStatusController');
    });
});
