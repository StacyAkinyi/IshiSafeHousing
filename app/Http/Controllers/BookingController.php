<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the incoming request
        $validated = $request->validate([
            'room_id' => ['required', 'exists:rooms,id'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        // 2. Check for booking conflicts
        $isAlreadyBooked = Booking::where('room_id', $validated['room_id'])
            ->where(function ($query) use ($validated) {
                $query->where(function($q) use ($validated) {
                    $q->where('start_date', '>=', $validated['start_date'])
                      ->where('start_date', '<=', $validated['end_date']);
                })->orWhere(function($q) use ($validated) {
                    $q->where('end_date', '>=', $validated['start_date'])
                      ->where('end_date', '<=', $validated['end_date']);
                })->orWhere(function($q) use ($validated) {
                    $q->where('start_date', '<', $validated['start_date'])
                      ->where('end_date', '>', $validated['end_date']);
                });
            })
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($isAlreadyBooked) {
            return back()->withErrors([
                'availability' => 'Sorry, this room is not available for the selected dates.'
            ])->withInput();
        }

        // 3. If no conflicts, create the booking
        $student = Auth::user()->student;
        Booking::create([
            'student_id' => $student->id,
            'room_id' => $validated['room_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        // 4. Redirect with a success message
        return redirect()->route('student.dashboard')->with('success', 'Booking request sent successfully!');
    }

}
