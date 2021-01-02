<?php

namespace Database\Seeders;


use App\Models\FriendshipStatus;
use App\Models\ParticipantStatus;
use App\Models\EventType;
use App\Models\EventStatus;
use App\Models\User;

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

        EventType::factory(10)->create();
    }
}
