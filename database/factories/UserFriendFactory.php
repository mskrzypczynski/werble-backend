<?php

namespace Database\Factories;

use App\Models\UserFriend;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFriendFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserFriend::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'               =>  $this->faker->numberBetween(1,5),
            'friend_id'             =>  $this->faker->numberBetween(6,10),
            'friendship_status_id'  =>  $this->faker->numberBetween(1,3),

            //'user_id'               => $this->create(App\Models\User::class)->id,
            //'friend_id'             => $this->create(App\Models\User::class)->id,
            //'friendship_status_id'  => $this->create(App\Models\FriendshipStatus::class)->id,

        ];
    }
}
