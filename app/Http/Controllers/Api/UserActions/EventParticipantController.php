<?php

namespace App\Http\Controllers\Api\UserActions;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventParticipantResource;
use App\Http\Resources\EventParticipantResourceCollection;
use App\Http\Resources\EventResource;
use App\Http\Resources\ProfileResource;
use App\Models\Event;
use App\Models\EventParticipant;

use App\Models\EventReview;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventParticipantController extends Controller
{
    public function joinEvent(Request $request, $eventId)
    {
        $user = $request->user();

        $event = Event::where('event_id', $eventId)->first();

        if (!$event)
            return response()->json(['message' => 'Event not found'], 404);

        $eventParticipant = new EventParticipant;
        $eventParticipant->event_id = $eventId;
        $eventParticipant->user_id = $user->user_id;
        $eventParticipant->is_creator = ($event->event_creator_id === $user->user_id);

        $eventParticipant->save();
        return response()->json(['message' => 'Successfully joined event'], 200);
    }

    public function leaveEvent(Request $request, $eventId)
    {
        $user = $request->user();
        $eventParticipant = EventParticipant::where('user_id', $user->user_id)
            ->where('event_id', $eventId)->firstOrFail();
        $eventParticipant->delete();

        return response()->json(['message' => 'Successfully left event'], 200);
    }


    public function getUserParticipatingEvents(Request $request)
    {
        $user = $request->user();
        $eventsParticipating = $user->eventsParticipating();
        return EventResource::collection($eventsParticipating);
    }

    public function getEventParticipantsProfiles(Request $request, $eventId)
    {
        //
        $event = Event::where('event_id', $eventId)->first();
        //$users = [];

        $participants = $event->participants()->get()->map(function ($participant){
            $participant['login'] = $participant->user()->first()->login;
            return $participant;
        });

        /*foreach ($participants as $participant) {
            array_push($users, $participant->user()->first());
        }*/

        return JsonResource::collection($participants);
    }

    public function softDeleteParticipant(Request $request, $participantId)
    {
        $participantId = EventReview::findOrFail($participantId);
        $participantId->delete();
        return response()->json(['message' => 'You have deactivated participant!'], 200);
    }


}
