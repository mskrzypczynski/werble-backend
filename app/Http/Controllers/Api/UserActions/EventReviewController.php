<?php

namespace App\Http\Controllers\Api\UserActions;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventReviewResource;
use App\Http\Resources\EventReviewResourceCollection;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Models\Event;
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

    public function getEventReviews(Request $request, $eventId)
    {
        $event = Event::where('event_id', $eventId)->first();

        return EventReviewResource::collection($event->reviews()->get());
    }

    public function editReview(Request $request, $eventId){
        $user = $request->user();
        $event = Event::where('event_id',$eventId)->firstOrFail();
        $event->event_id = $eventId;
            //USER->PARTICIPANTS->WHERE
        //$participant = EventReview::where('event_participant_id',$participantId)->firstOrFail();
        //$participant->event_participant_id = $participantId;

        $participant = $user->participants()->where('event_id',$eventId)->firstOrFail();

        $review = $participant->review()->firstOrFail();

        if(!$user->user_id === $event->event_creator_id )
            return response()->json(403,'You dont have right to do this');

        // model attrs to change sent in request, check if they exist
        $toCheck = [
            'rating' => 'required',
            'content' => 'required',
        ];
        $toUpdate = [];


        foreach ($toCheck as $key => $value) if ($request->has($key)) $toUpdate[$key] = $value;

        // validate sent data
        $this->validate($request,$toUpdate);

        // update only sent attr
        foreach ($toUpdate as $key => $value) $review[$key] = $request[$key];

        $review->save();
        return (new EventReviewResource($review))->response()->setStatusCode(200);
    }

    public function getSingleReview(Request $request,$eventId)
    {
        $user = $request->user();
        $participant = EventParticipant::where('user_id',$user->user_id)->where('event_id',$eventId)->firstOrFail();
        $review = $participant->review()->first();
         return  $review;
    }

    public function softDeleteReview(Request $request, $reviewId){
        $reviewId =  EventReview::findOrFail($reviewId);
        $reviewId->delete();
        return response()->json(['message' => 'You have deactivated your review!'],200);
    }
}
