<?php

namespace Database\Seeders;


use App\Models\FriendshipStatus;
use App\Models\ParticipantStatus;
use App\Models\EventType;
use App\Models\EventStatus;
use App\Models\User;

use Doctrine\DBAL\Schema\Sequence;
use Illuminate\Database\Seeder;

class NoRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create users
        User::factory(10)->create();

        $eventTypeNames =[
            'Biking',
            'Birthday',
            'Board games',
            'Concert',
            'Festival',
            'Gym',
            'Party',
            'Running',
            'Swimming',
            'Walk',
        ];


        foreach($eventTypeNames as $eventType){
            EventType::factory()->create(['event_type_name' => $eventType]);
    }


    }
}
