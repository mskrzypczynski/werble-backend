<?php

use App\Http\Controllers\WelcomeController;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth::routes();
Route::get('/', function () {
    return view('pages.welcome');
    //return  file('laravel/resources/views/index.html');
});

Route::get('logout', function () {
    return view('pages.welcome');
    //return  file('laravel/resources/views/index.html');
});

Route::get('login', function () {
    return view('pages.login');
});

Route::get('signup', function () {
    return view('pages.signup');
});

Route::get('home', function () {
    return view('pages.home');
});

Route::get('users/{user}', function(){
    return User::paginate(20);
});

Route::get('yourevents', function () {
    $event = Event::findOrFail(1); //user_id!
    return view('pages.yourevents',compact('event'));
});
/*
Route::get('profile', function(User $user){
    //$id = Auth::user()->user_id;
    //$user = Auth::id();
    $user = Auth::guard('api')->user();
    //dd($user);
    return view('pages.profile',['user' => $user]);
})->middleware('auth:web');
*/


Route::get('profile', function() {
    //if (Auth::guard('user:api')->check()) {
    $user = Auth::guard('api')->user();
    return view('pages.profile', ['user' => $user]);
    /*} else {
        return response('Unauthenticated user');
    }*/
});


