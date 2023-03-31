<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // $room_type = \App\Models\room_types::inRandomOrder()->first();

    public function definition(): array
    {
        $ship = \App\Models\Ship::inRandomOrder()->first();
        $cruise = \App\Models\cruise::inRandomOrder()->first();
        $RoomType = \App\Models\RoomType::inRandomOrder()->first();

        $faker = \Faker\Factory::create();
        return [
            'ship_id' => $ship ? $ship->id : \App\Models\Ship::factory()->create()->id,
            'cruise_id' => $cruise ? $cruise->id : \App\Models\cruise::factory()->create()->id,
            'room_type_id' => $RoomType ? $RoomType->id : \App\Models\RoomType::factory()->create()->id,
        ];
    }
}
