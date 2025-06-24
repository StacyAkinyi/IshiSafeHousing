<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Agent;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'student', // Default role
        ];
    }

    // STATE for creating a Student
    public function student(): Factory
    {
        return $this->state(fn (array $attributes) => ['role' => 'student'])
            ->afterCreating(function (User $user) {
                // After creating the User, also create a Student profile for them
                Student::factory()->create(['user_id' => $user->id]);
            });
    }

    // STATE for creating an Agent
    public function agent(): Factory
    {
        return $this->state(fn (array $attributes) => ['role' => 'agent'])
            ->afterCreating(function (User $user) {
                // After creating the User, also create an Agent profile for them
                Agent::factory()->create(['user_id' => $user->id]);
            });
    }
    
    // STATE for creating an Admin
    public function admin(): Factory
    {
        return $this->state(fn (array $attributes) => ['role' => 'admin']);
    }
}
