<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;
use App\Models\RoomImage;

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
    public function definition(): array
    {
        return [
            'room_number' => fake()->bothify('R##'),
            'description' => fake()->sentence(10),
            'rent' => fake()->numberBetween(15000, 40000),
            'capacity' => fake()->randomElement([1, 2]),
            'is_available' => fake()->boolean(80), // 80% chance of being available
        ];
    }
    public function configure(): static
    {
        return $this->afterCreating(function (Room $room) {
            // Create 3 images for each room
            RoomImage::factory()->count(3)->create(['room_id' => $room->id]);
        });
    }
}
