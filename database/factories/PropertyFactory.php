<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company() . ' ' . $this->faker->randomElement(['Apartments', 'Hostel', 'Residency']),
            'type' => $this->faker->randomElement(['Apartment', 'Hostel', 'House', 'Studio']),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'description' => $this->faker->paragraph(3),
            'status' => $this->faker->randomElement(['available', 'full', 'under_maintenance']),
            'latitude' => $this->faker->latitude(-1.4, -1.2),
            'longitude' => $this->faker->longitude(36.7, 36.9),

        ];
    }
}
