<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\UserActions\EventController;
use App\Http\Controllers\Api\UserActions\EventParticipantController;
use App\Http\Controllers\Api\UserActions\EventReviewController;
use App\Http\Controllers\Api\UserActions\EventTypeController;
use App\Http\Controllers\Api\UserActions\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('register', [RegisterController::class, 'register'])->name('register.api');
    Route::post('login', [LoginController::class, 'login'])->name('login.api');
});

// Private routes
Route::group(['middleware' => ['cors', 'json.response', 'auth:api']], function () {

    //logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout.api');
    Route::post('logout_all', [LoginController::class, 'logoutAll'])->name('logoutAll.api');
    Route::post('refresh', [LoginController::class, 'refresh'])->name('refresh.api');


    Route::group(['prefix' => 'user'], function () {
        // user profile routes
        Route::get('profile', [ProfileController::class, 'getAuthenticatedUserProfile']);
        Route::put('profile', [ProfileController::class, 'editAuthenticatedUserProfile']);
        Route::delete('profile', [ProfileController::class, 'deactivateAuthenticatedUserProfile']);
        Route::put('profile/editpassword', [ProfileController::class, 'updatePassword']);
        Route::put('profile/editemail', [ProfileController::class, 'updateEmail']);
        Route::put('profile/position', [ProfileController::class, 'updateUserPosition']);

        // events and participants routes
        Route::get('events', [EventController::class, 'getAllEvents']);
        Route::post('events', [EventController::class, 'createEvent']);
        Route::get('events/owned', [EventController::class, 'getOwnedEvents']);
        Route::get('events/local', [EventController::class, 'getLocalEvents']);
        Route::get('events/participating', [EventController::class, 'getParticipatingEvents']);
        Route::get('events/{id}', [EventController::class, 'getSingleEvent']);
        Route::get('events/{id}/wrapped', [EventController::class, 'getEventWithParticipantsWithUserAndReview']);

        Route::put('events/{id}', [EventController::class, 'editEvent']);
        Route::delete('events/{id}', [EventController::class, 'softDeleteEvent']);
        Route::get('events/{id}/participants', [EventParticipantController::class, 'getEventParticipantsProfiles']);
        Route::post('events/{id}/join', [EventParticipantController::class, 'joinEvent']);
        Route::delete('events/{id}/leave', [EventParticipantController::class, 'leaveEvent']);
        Route::get('participants', [EventParticipantController::class, 'getUserParticipatingEvents']);

        // event reviews routes
        Route::get('events/{id}/reviews', [EventReviewController::class, 'getEventReviews']);
        Route::get('events/{id}/review', [EventReviewController::class, 'getSingleReview']);
        Route::put('events/{id}/review', [EventReviewController::class, 'editReview']);
        Route::post('reviews', [EventReviewController::class, 'createReview']);
        Route::delete('reviews/{id}', [EventReviewController::class, 'softDeleteReview']);

        Route::get('types', [EventTypeController::class, 'index']);
    });
});
