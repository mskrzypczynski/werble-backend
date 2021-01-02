<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'login'                     =>  $this->faker->userName,
            'email'                     =>  $this->faker->unique()->safeEmail,
            'email_verified_at'         =>  now(),
            'password'                  =>  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'first_name'                =>  $this->faker->firstName,
            'last_name'                 =>  $this->faker->lastName,
            'birth_date'                =>  $this->faker->date(),
            'description'               =>  $this->faker->text(),
            'longitude'                 =>  $this->faker->longitude,
            'latitude'                  =>  $this->faker->latitude,
            'is_admin'                  =>  false,
            'is_active'                 =>  $this->faker->boolean(90),
            'remember_token'            =>  Str::random(10),
        ];
    }
}
