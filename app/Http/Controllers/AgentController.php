<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Room;
use App\Models\Agent;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function dashboard(){
        
        $user = Auth::user();
        $agent = $user->agent;


        $properties = Property::all();
        $rooms = $agent->rooms()->latest()->get(); // Fetch all rooms with their associated properties
        $bookings = $agent->bookings()
                          ->with(['student.user', 'room.property'])
                          ->latest('bookings.created_at')
                          ->get();

        
        $roomCount = $agent->rooms()->count();

        // Count of all bookings for this agent's rooms
        $bookingCount = $agent->bookings()->count();

        // Count of all reviews for this agent's rooms
        $reviewCount = Review::whereHas('booking.room', function ($query) use ($agent) {
            $query->where('agent_id', $agent->id);
        })->count();


        // === 2. DATA FOR GRAPHS ===

        // Graph 1: Agent's rooms, grouped by property
        $roomsByProperty = Room::where('agent_id', $agent->id)
            ->with('property') // Eager load property to get its name
            ->select('property_id', DB::raw('count(*) as room_count'))
            ->groupBy('property_id')
            ->get()
            ->map(function ($item) {
                // Map to a simpler format for the chart
                return [
                    'property_name' => $item->property->name,
                    'count' => $item->room_count,
                ];
            });
            
        // Graph 2: Agent's bookings, grouped by property
        $bookingsByProperty = Booking::whereHas('room', function ($query) use ($agent) {
                $query->where('agent_id', $agent->id);
            })
            ->with('room.property')
            ->get()
            ->groupBy('room.property.name')
            ->map(function ($group) {
                return $group->count();
            });

        // Graph 3: Agent's reviews, grouped by property
        $reviewsByProperty = Review::whereHas('booking.room', function ($query) use ($agent) {
                $query->where('agent_id', $agent->id);
            })
            ->with('booking.room.property')
            ->get()
            ->groupBy('booking.room.property.name')
            ->map(function ($group) {
                return $group->count();
            });


        // === 3. PASS ALL DATA TO THE VIEW ===
        return view('agent.dashboard', [
            'roomCount' => $roomCount,
            'bookingCount' => $bookingCount,
            'reviewCount' => $reviewCount,
            'roomsByProperty' => $roomsByProperty,
            'bookingsByProperty' => $bookingsByProperty,
            'reviewsByProperty' => $reviewsByProperty,
            'bookings' => $agent->bookings()->with(['student.user', 'room.property'])->latest('bookings.created_at')->get(),
            'properties' => $properties,
            'rooms' => $rooms,
        ]);
    }

    public function updateAccount(Request $request)
        {
            $user = Auth::user();
            $agent = $user->agent;

            // 1. VALIDATE THE FORM DATA
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'phone_number' => ['required', 'string', 'max:20'],
                'license_number' => ['required', 'string', 'max:255', Rule::unique('agents')->ignore($agent->id)],
            ]);

            // 2. USE A DATABASE TRANSACTION FOR SAFETY
            // This ensures that both updates succeed, or neither do.
            try {
                DB::transaction(function () use ($user, $agent, $validated) {
                    // Update the users table
                    $user->update([
                        'name' => $validated['name'],
                        'email' => $validated['email'],
                    ]);

                    // Update the agents table
                    $agent->update([
                        'phone_number' => $validated['phone_number'],
                        'license_number' => $validated['license_number'],
                    ]);
                });
            } catch (\Exception $e) {
                // If anything goes wrong, redirect back with an error
                return redirect()->back()->with('error', 'There was a problem updating your profile.');
            }

            // 3. REDIRECT WITH A SUCCESS MESSAGE
            return redirect()->route('agent.dashboard')
                            ->with('success', 'Your account details have been updated successfully!')
                            ->with('active_section', 'account'); // To re-open the 'My Account' tab
        }
}
