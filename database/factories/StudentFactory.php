<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'phone_number' => fake()->unique()->phoneNumber(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Student $student) {
            NextOfKin::factory()->create(['student_id' => $student->id]);
        });
    }
}
