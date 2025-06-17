<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;


class StudentController extends Controller
{
     public function dashboard()
    {
        // Get the currently authenticated student
        $student = Auth::user();

        // Fetch all properties with available rooms to show to the student
        $availableProperties = Property::whereHas('rooms', function ($query) {
            $query->where('is_available', true);
        })->withCount(['rooms' => function ($query) {
            $query->where('is_available', true);
        }])->latest()->get();
        
        // Fetch only the bookings belonging to this student
        $myBookings = Booking::where('user_id', $student->id)
                             ->with('property', 'room') // Eager load relationships
                             ->latest()
                             ->get();
        
        // Fetch only the reviews written by this student
        $myReviews = Review::where('user_id', $student->id)
                           ->with('property') // Eager load relationships
                           ->latest()
                           ->get();

        // Pass the data to the view
        return view('student.dashboard', [
            'availableProperties' => $availableProperties,
            'myBookings'          => $myBookings,
            'myReviews'           => $myReviews,
        ]);
    }
}
