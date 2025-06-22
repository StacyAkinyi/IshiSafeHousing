<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;
use App\Models\NextOfKin;
use App\Models\Student; 
use Illuminate\Validation\Rule;



class StudentController extends Controller
{
     public function dashboard()
    {
       $user = Auth::user();

        // Find the student profile, or create it if it doesn't exist
        $student = $user->student()->firstOrCreate(
            ['user_id' => $user->id]);
        $student->load('nextOfKin', 'user');

        // Fetch all properties with available rooms to show to the student
        $availableProperties = Property::whereHas('rooms', function ($query) {
            $query->where('is_available', true);
        })->withCount(['rooms' => function ($query) {
            $query->where('is_available', true);
        }])->latest()->get();
        
        // Fetch only the bookings belonging to this student
        $myBookings = $student->bookings()->with('room.property')->latest()->get();

        $reviewableBookings = Booking::where('student_id', $student->id)
            ->whereIn('status', ['confirmed', 'completed'])
            ->whereDoesntHave('review')
            ->with('room.property')
            ->latest()
            ->get();
        
        // Fetch only the reviews written by this student
       $myReviews = Review::whereHas('booking', function ($query) use ($student) {
                    $query->where('student_id', $student->id);
                })->with('booking.room.property')->latest()->get();

        // Pass the data to the view
        return view('student.dashboard', [
            'student'            => $student,
            'availableProperties' => $availableProperties,
            'myBookings'          => $myBookings,
            'myReviews'           => $myReviews,
        ]);
    }
     public function updateDetails(Request $request)
    {
        $user = Auth::user();
        $student = $user->student;

        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'full_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
        ]);

        $user->update([
            'name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
        ]);
        $student->update([
            'full_name' => $validatedData['full_name'],
            'phone_number' => $validatedData['phone_number'],
        ]);

        
          return redirect()->route('student.dashboard')
                         ->with('success', 'Personal details updated successfully!')
                         ->with('active_section', 'account'); 
    }

    /**
     * Create or update the user's next of kin details.
     */
    public function updateNextOfKin(Request $request)
    {
        $student = Auth::user()->student;

        $validatedData = $request->validate([
            'kin_name' => ['required', 'string', 'max:255'],
            'kin_relationship' => ['required', 'string', 'max:255'],
            'kin_id_number' => ['nullable', 'string', 'max:255'],
            'kin_phone_number' => ['required', 'string', 'max:20'],
            'kin_email' => ['nullable', 'string', 'email', 'max:255'],
             
        ]);

        $nextOfKin = $student->nextOfKin()->updateOrCreate(
            ['student_id' => $student->id],
            [
                'name' => $validatedData['kin_name'],
                'relationship' => $validatedData['kin_relationship'],
                'id_number' => $validatedData['kin_id_number'],
                'phone_number' => $validatedData['kin_phone_number'],
                'email' => $validatedData['kin_email'],

            ]
        );

          return redirect()->route('student.dashboard')
                         ->with('success', 'Personal details updated successfully!')
                         ->with('active_section', 'account'); 
    }
}
