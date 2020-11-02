<?php

namespace Database\Seeders;
use App\Models\Event_participant;
use App\Models\Event;
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


        User::factory()->create(
            [   'email' => 'test2@test.com',
                'password' => bcrypt('password')
            ]
        );
    }

}
