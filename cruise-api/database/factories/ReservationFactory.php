<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $room = \App\Models\room::inRandomOrder()->first();
        $cruise = \App\Models\cruise::inRandomOrder()->first();
        $parking = \App\Models\parking::inRandomOrder()->first();
        $user = \App\Models\User::inRandomOrder()->first();
        $faker = \Faker\Factory::create();
        
        return [
            
                'user_id'=>$user ? $user->id : \App\Models\User::factory()->create()->id,
            	'cruise_id'=>$cruise ? $cruise->id : \App\Models\cruise::factory()->create()->id,
                'room_id'=>$room ? $room->id : \App\Models\room::factory()->create()->id,
                'parking_id'=>$parking ? $parking->id : \App\Models\parking::factory()->create()->id,
                'price' => $this->faker->randomNumber(5),
        ];
    }
}
