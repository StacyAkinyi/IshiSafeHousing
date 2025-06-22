<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => ['required', 'exists:bookings,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $booking = Booking::findOrFail($validated['booking_id']);

        // Authorization check remains the same and is critical
        if ($booking->student_id !== Auth::user()->student->id) {
            abort(403, 'Unauthorized action.');
        }

        // The create call is now much simpler
        Review::create($validated);

        return redirect()->route('student.dashboard')
                        ->with('success', 'Thank you for your review!')
                        ->with('active_section', 'reviews'); // Go back to reviews tab
    }
}