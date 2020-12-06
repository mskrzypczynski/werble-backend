<?php

namespace App\Http\Controllers\Api\UserActions;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventReviewResource;
use App\Http\Resources\EventReviewResourceCollection;
use App\Http\Resources\UserResource;
use App\Models\EventParticipant;
use App\Models\EventReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventReviewController extends Controller
{
    public function createReview(Request $request){
        $user = $request->user();
        $userId = $user->user_id;


        $participantId = EventParticipant::where('user_id', $userId)
            ->where('event_id',$request->event_id)
            ->firstOrFail()->event_participant_id;


        $this->validate($request,
            [
                'event_id' => 'required',
                'content' => 'required',
                'rating' => 'required',
            ]);
        $review = new EventReview;

        $review->event_participant_id = $participantId;
        $review->event_id =$request->event_id;
        $review->content = $request['content'];
        $review->rating = $request->rating;
        $review->save();

        $response = ['message' => 'You have created review!'];
        return response()->json($response, 200);


    }
}
