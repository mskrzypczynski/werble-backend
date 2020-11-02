<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\EventReview;
use App\Models\EventStatus;
use App\Models\EventType;
use App\Models\User;
use App\Models\UserFriend;


use Illuminate\Database\Seeder;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //get all Users
        $user = User::all();

        Event::factory(10)
               ->create();

        EventParticipant::factory(100)->create();
    }
}
//to do || create event_participant with creator when creating event
