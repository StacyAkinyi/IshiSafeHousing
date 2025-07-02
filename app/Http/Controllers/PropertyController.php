<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Room;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function getRooms(Property $property)
    {
        // Eager load the rooms that are marked as available
        $availableRooms = $property->rooms()->with('images', 'agent.user')->where('is_available', true)->get();

            

        return response()->json([
            'property_name' => $property->name,
            'rooms' => $availableRooms
        ]);
    }

    public function search(Request $request)
        {
            $request->validate(['city' => 'required|string|max:255']);
            $city = $request->input('city');

            $properties = Property::query()
                // Add the calculated columns to the select statement
                ->addSelect([
                    '*', // Select all original columns from the properties table
                    
                    // This subquery calculates the total number of reviews for the property
                    'reviews_count' => DB::table('reviews')
                        ->join('bookings', 'reviews.booking_id', '=', 'bookings.id')
                        ->join('rooms', 'bookings.room_id', '=', 'rooms.id')
                        ->whereColumn('rooms.property_id', 'properties.id')
                        ->selectRaw('count(*)'),

                    // This subquery calculates the average rating for the property
                    'reviews_avg_rating' => DB::table('reviews')
                        ->join('bookings', 'reviews.booking_id', '=', 'bookings.id')
                        ->join('rooms', 'bookings.room_id', '=', 'rooms.id')
                        ->whereColumn('rooms.property_id', 'properties.id')
                        ->selectRaw('avg(rating)'),
                ])
                // Get the count of available rooms separately
                ->withCount(['rooms' => function ($query) {
                    $query->where('is_available', true);
                }])
                // Now, filter the properties
                ->where('city', 'like', "%{$city}%")
                ->whereHas('rooms', function ($query) {
                    $query->where('is_available', true);
                })
                ->paginate(12);

            return view('properties.index', [
                'properties' => $properties,
                'searchCity' => $city,
            ]);
        }

        public function show(Property $property)
    {
        // Eager load the rooms and all their related data
        $property->load(['rooms' => function ($query) {
            $query->with(['agent.user', 'images']);
        }]);

        return view('properties.show', ['property' => $property]);
    }


    public function reviews(Property $property)
    {
        // Step 1: Get all the room IDs that belong to this property.
        $roomIds = $property->rooms()->pluck('id');

        // Step 2: Get all the bookings that are associated with those rooms.
        $bookingIds = Booking::whereIn('room_id', $roomIds)->pluck('id');

        // Step 3: Now, fetch all reviews that belong to those bookings.
        // We also eager-load the user information to display the reviewer's name.
        $reviews = Review::whereIn('booking_id', $bookingIds)
                         ->with('booking.student.user') // Eager load for efficiency
                         ->latest() // Show the newest reviews first
                         ->get();

        // Step 4: Return the view, passing both the property and the collection of reviews.
        return view('properties.reviews', [
            'property' => $property,
            'reviews' => $reviews,
        ]);
    }

}
