<?php

namespace Database\Seeders;




use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\EventReview;
use App\Models\EventStatus;
use App\Models\EventType;
use App\Models\ParticipantStatus;
use App\Models\User;
use App\Models\UserFriend;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NoRelationshipSeeder::class);
        $this->call(RelationshipSeeder::class);
    //EventParticipant::factory(3) ->create(3);
    //User::factory(10)->create();
    //UserFriend::factory(3)->create();
    //EventStatus::factory(3)->create();
    //EventType::factory(3)->create();
    //Event::factory(5)->create();
    //EventParticipant::factory(5)->create();
    //EventReview::factory(2)->create();
    //ParticipantStatus::factory(5)->create();
    }
}

