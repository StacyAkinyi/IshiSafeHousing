<?php

namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\User;
use App\Models\Property;
use App\Models\RoomImage;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'room_number' => 'nullable|string|max:255|unique:rooms,room_number',
            'description' => 'nullable|string',
            'rent'        => 'required|numeric',
            'capacity'    => 'required|integer|min:1',
            'images'      => 'nullable|array', 
            // Validate EACH item in the 'images' array
            'images.*'    => 'image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        // 2. GET THE LOGGED-IN AGENT'S ID
        // auth()->id() gets the ID of the currently authenticated user.
        $validatedData['agent_id'] = auth()->id();
        
        // 3. HANDLE OTHER FIELDS
        $validatedData['is_available'] = $request->has('is_available');

        // Optional: Auto-generate room number if not provided
        if (empty($validatedData['room_number'])) {
            $roomCount = Room::where('property_id', $validatedData['property_id'])->count() + 1;
            $validatedData['room_number'] = $validatedData['property_id'] . '_R' . $roomCount;
        }

        // 4. CREATE THE ROOM
       $room = Room::create($validatedData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                // Store the image in 'storage/app/public/room_images'
                // This generates a unique filename to avoid conflicts.
                $path = $imageFile->store('room_images', 'public');

                // Create a record in the 'room_images' table using the relationship
                // This automatically sets the 'room_id' for us.
                $room->images()->create([
                    'path' => $path
                ]);
            }
        }

        return redirect()->back()->with('success', 'Room added successfully.');
    }
    public function index()
    {
        $rooms = Room::with('property', 'agent')->get(); // Fetch all rooms with their associated properties and agents
        return view('rooms.index', compact('rooms'));
    }

}


   