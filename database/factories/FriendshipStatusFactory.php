<?php

namespace Database\Factories;

use App\Models\FriendshipStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class FriendshipStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FriendshipStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'friendship_status_name' => $this->faker->text(15),
        ];
    }
}
