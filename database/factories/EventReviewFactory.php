<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventReview;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventReview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content'               =>  $this->faker->text(),
            'rating'                =>  $this->faker->numberBetween(1,5),
            'event_participant_id'  =>  $this->faker->numberBetween(1,10),
        ];
    }
}
