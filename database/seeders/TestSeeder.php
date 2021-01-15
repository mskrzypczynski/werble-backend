<?php

namespace Database\Seeders;
use App\Models\Event_participant;
use App\Models\Event;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = ['kamil123', 'maciek1', 'wielebnybard', 'andrzej_k', 'kowalskijan'];

        foreach ($users as $user) {

            User::factory()->create([

                    'login' => $user,
                    'email' => $user . '@' . $user . '.com',
                    'password' => bcrypt('12345678'),

            ]);
        }

        $eventTypeNames = [
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


        foreach ($eventTypeNames as $eventType) {
            EventType::factory()->create(['event_type_name' => $eventType]);

        }

    }
}
