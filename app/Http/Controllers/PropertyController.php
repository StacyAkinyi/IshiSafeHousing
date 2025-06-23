<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

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

            $properties = Property::where('city', 'like', "%{$city}%")
                ->whereHas('rooms', function ($query) {
                    $query->where('is_available', true); // Only show properties with available rooms
                })
                ->withCount(['rooms' => function ($query) {
                    $query->where('is_available', true);
                }])
                ->paginate(12); // Paginate the results

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
    


}
