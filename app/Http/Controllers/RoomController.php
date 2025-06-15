<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'agent_id' => 'required|exists:users,id',
            'room_number' => 'nullable|string|max:255|unique:rooms,room_number',
            'description' => 'nullable|string',
            'rent' => 'required|numeric',
            'capacity' => 'required|integer|min:1',
            'is_available' => 'required|boolean',
            
        ]);

        $propertyId = $request->property_id;

        // Count existing rooms for this property
        $roomCount = Room::where('property_id', $propertyId)->count() + 1;

        // Generate room_number like 1_R1, 1_R2, etc.
        $roomNumber = $propertyId . '_R' . $roomCount;

        Room::create([
            'property_id' => $propertyId,
            'agent_id' => $request->agent_id,
            'room_number' => $roomNumber,
            'description' => $request->description,
            'rent' => $request->rent,
            'capacity' => $request->capacity,
            'is_available' => $request->is_available,

        ]);

        return redirect()->back()->with('success', 'Room added successfully.');
    }

}
