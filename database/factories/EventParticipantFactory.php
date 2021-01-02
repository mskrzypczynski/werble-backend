<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\ParticipantStatus;
use App\Models\EventParticipant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventParticipantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventParticipant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //get random event
        $event = Event::all()->random();

        //get random user
        $user = User::all()->random();

        return [
            'user_id'                    => $user->user_id,
            'is_creator'                 => $user->user_id == $event->event_creator_id,
            'event_id'                   => $event->event_id,
        ];
    }
}

