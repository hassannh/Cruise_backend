<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parking>
 */
class ParkingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $ship = \App\Models\Ship::inRandomOrder()->first();
        return [
            
            'place_number'=>$this->faker->randomNumber(),
            'ship_id' => $ship ? $ship->id : \App\Models\Ship::factory()->create()->id,
        ];
    }
}
