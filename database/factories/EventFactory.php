<?php

namespace Database\Factories;

use App\Models\event;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $now = $this->faker->dateTimeBetween('now','+20 days');
        $end = $this->faker->dateTimeBetween($now,$now->modify('+5hours'));

        
        return [
            'name'                          =>  $this->faker->text(30),
            'location'                      =>  $this->faker->city,
            'zip_code'                      =>  $this->faker->postcode,
            'street_name'                   =>  $this->faker->streetName,
            'house_number'                  =>  $this->faker->randomNumber(5),
            'longitude'                     =>  $this->faker->longitude,
            'latitude'                      =>  $this->faker->latitude,
            'description'                   =>  $this->faker->text(),
            'start_datetime'                =>  $now,
            'end_datetime'                  =>  $end,
            'status'                        =>  2,
            'event_creator_id'              =>  User::all()->random()->user_id,
            'event_type_id'                 =>  EventType::all()->random()->event_type_id,
        ];
    }
}
