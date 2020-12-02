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
            'is_active'             =>  $this->faker->boolean(90),
            'event_participant_id'  =>  $this->faker->numberBetween(1,10),
            'event_id'              =>  Event::all()->random()->event_id,



        ];
    }
}
/*
    $table->string('review_content');
    $table->integer('event_rating');
    $table->dateTime('review_datetime');
    $table->boolean('review_is_active');
    $table->bigInteger('event_participant_id')->unsigned();
    $table->bigInteger('event_id')->unsigned()
*/
