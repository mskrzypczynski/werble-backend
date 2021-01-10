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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventParticipantController extends Controller
{
    public function joinEvent(Request $request, $eventId)
    {
        $user = $request->user();
        $event = Event::where('event_id', $eventId)->firstOrFail();

        $participant = EventParticipant::withTrashed()
            ->where('user_id',$user->user_id)
            ->where('event_id',$event->event_id)
            ->first();

        if($participant)
        {
            $participant->restore();
            $participant->created_at = Carbon::now();
            return response()->json(['message' => 'Successfully joined event'], 200);
        }

        $participant = new EventParticipant;
        $participant->event_id = $eventId;
        $participant->user_id = $user->user_id;
        $participant->is_creator = ($event->event_creator_id === $user->user_id);
        $participant->save();

        return response()->json(['message' => 'Successfully joined event'], 200);
    }

    public function leaveEvent(Request $request, $eventId)
    {
        $user = $request->user();
        $participant = $user->participants()->where('event_id', $eventId)->firstOrFail();
        $participant->delete();

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
        $event = Event::where('event_id', $eventId)->first();
        $participants = $event->participantsWithLogin();
        return JsonResource::collection($participants);
    }

    public function softDeleteParticipant(Request $request, $participantId)
    {
        $participantId = EventReview::findOrFail($participantId);
        $participantId->delete();
        return response()->json(['message' => 'You have deactivated participant!'], 200);
    }


}
