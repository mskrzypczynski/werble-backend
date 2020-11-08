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


        $user = User::factory()->create(
            [
                'login' => 'admin2',
                'email' => 'admin2@app.com',
                'password' => bcrypt('password'),
                'is_admin' => 0,
            ]
        );
        $user->createToken('Laravel Password Grant Client')->accessToken;
    }

}
