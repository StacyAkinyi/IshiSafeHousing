<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\Room;
use App\Models\Agent;
use App\Models\Student;
use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

       
        User::factory()->count(4)->agent()->create();
        User::factory()->count(10)->student()->create();


        Property::factory()->count(6)->create();


        $agents = Agent::all();
        $properties = Property::all();

        
        $properties->each(function ($property) use ($agents) {
            Room::factory()->count(rand(5, 15))->create([
                'property_id' => $property->id,
                'agent_id' => $agents->random()->id,
            ]);
        });

        
        $students = Student::all();
        $rooms = Room::all();


        for ($i = 0; $i < 10; $i++) {
            Booking::factory()->create([
                'student_id' => $students->random()->id,
                'room_id' => $rooms->random()->id,
            ]);
        }
    }
}
