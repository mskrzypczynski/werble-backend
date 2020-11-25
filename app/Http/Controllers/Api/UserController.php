<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserResourceCollection
     */
    public function index(): UserResourceCollection
    {
        return new UserResourceCollection(User::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return UserResource
     */
    public function store(Request $request)
    {
        $request->validate([
            //'user_id' => 'required',
            'login' => 'required|unique',
            'email'=> 'required|unique',
            //'email_verified_at'=> 'required',
            'password'=> 'required',
            'first_name'=> 'required',
            'last_name'=> 'required',
            'birth_date'=> 'required',
            //'user_description'=> 'required',
            'longitude'=> 'required',
            'latitude'=> 'required',
            'is_admin'=> 'required',
            'user_is_active'=> 'required',
            'api_token'=> 'required|unique',
            //'remember_token'=> 'required',
            //'created_at'=> 'required',
            //'updated_at'=> 'required'
        ]);

        $user = User::create($request->all());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user) : UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @param Request $request
     * @return UserResource
     */
    public function update(User $user, Request $request): UserResource
    {
        $request->validate([
            'login' => 'required',
            'email'=> 'required',
            'password'=> 'required',
            'first_name'=> 'required',
            'last_name'=> 'required',
            'birth_date'=> 'required',
        ]);

        $user->update($request->all());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     */
    public function destroy(User $user)
    {
        $user->is_active=0;
        $user->save();

    }

    public function userEvents(Request $request){
        $user = Auth::guard('api')->user();
        return EventResource::collection($user->events()->get());
    }

    public function createEvent(Request $request){
        $userId = Auth::guard('api')->user()->user_id;
        $this->validate($request,
            [
                'name' =>'required',
                'location'=>'required',
                'description'=>'nullable',
                'datetime' => 'required',
            ]);

        //$event = Event::create($request->all());
        $event = Event::create([
                'name' =>$request->name,
            'location' =>$request->location,
            'description'=>$request->description,
            'datetime'=>'2020-11-25 23:36:17',
            'event_creator_id' => $userId
        ]);

        $response = ['message' => 'You have created event!'];
        return response()->json($response,200);
    }

    public function login( Request $request ) {

        $login = $request->only('login','password');

        if ( !Auth::attempt( $login )) {
            return response( ['message' => 'Invalid login credentials.'] );
        }
        $user = $request->user();

        if ($user) { // Check if we have users in the database
            $accessToken = $user->createToken('authToken')->accessToken;
            return response(['user' => Auth::user(), 'access_token' => $accessToken]);
        } else {
            return response( ['message' => 'No user found in the database.'] );
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();

            return response()->json([
                'message' => 'Successfully logged out']);
        }
        else return response()->json([
            'message' => 'You hadnt logged out!']);

    }

    public  function signup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'login' => 'required|string|unique:users|max:30',
            'email' => 'required|string|unique:users|max:50',
            'password' => 'required|string|max:64'
        ]);
//dd($request->all());
        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = new User([
                'login' => $request->login,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'api_token' => Str::random(80)]);
            $user->save();
            //return redirect('/')->with('success', 'user singned up successfully!');
            return response()->json(['success', 'user singned up successfully!']);
        }
    }


}
