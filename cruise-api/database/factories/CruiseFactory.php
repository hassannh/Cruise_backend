<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cruise>
 */
class CruiseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $port = \App\Models\Port::inRandomOrder()->first();
        $ship = \App\Models\Ship::inRandomOrder()->first();
        return [
            'name' => $this->faker->name,
            'ship_id' => $ship ? $ship->id : \App\Models\Ship::factory()->create()->id,
            'price' => $this->faker->randomNumber(3),
            'picture' => $this->faker->text(30),
            'nights_number' => $this->faker->randomNumber(3),
            'port_id' => $port ? $port->id : \App\Models\Port::factory()->create()->id,
        ];
    }
}
