<?php

namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\User;
use App\Models\Property;
use App\Models\RoomImage;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RoomController extends Controller
{
     public function store(Request $request)
        {

            $validatedData = $request->validate([
                'property_id' => ['required', 'exists:properties,id'],
                'room_number' => ['nullable', 'string', 'max:255', Rule::unique('rooms')->where('property_id', $request->property_id)],
                'description' => ['nullable', 'string'],
                'rent'        => ['required', 'integer', 'min:0'],
                'capacity'    => ['required', 'integer', 'min:1'],
                'images'      => ['nullable', 'array'], 
                'images.*'    => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], 
            ]);

            
            $agent = Auth::user()->agent;


            if (!$agent) {
                return redirect()->back()->with('error', 'You must have an agent profile to perform this action.')->withInput();
            }
            if (empty($validatedData['room_number'])) {
                $propertyId = $validatedData['property_id'];
                // Count existing rooms for this specific property to get the next number
                $roomCount = Room::where('property_id', $propertyId)->count() + 1;
                // Assign the new, unique room number (e.g., P1_R1)
                $validatedData['room_number'] = 'P' . $propertyId . '_R' . $roomCount;
            }

            // 4. Add the correct agent_id to the data we will save
            $validatedData['agent_id'] = $agent->id;
            
            // Handle is_available checkbox if you have one
            $validatedData['is_available'] = $request->has('is_available');

            // 5. Create the Room with the correct data
            $room = Room::create($validatedData);
            
            // 6. Handle image uploads (your existing logic is correct)
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $imageFile) {
                    $path = $imageFile->store('room_images', 'public');
                    $room->images()->create([
                        'path' => $path
                    ]);
                }
            }

            return redirect()->route('agent.dashboard')->with('success', 'Room added successfully.');
        }

        public function index()
        {
            // This method can also be improved to only show rooms for the current agent
            $agent = Auth::user()->agent;
            $rooms = $agent ? $agent->rooms()->with('property')->get() : collect();

            return view('rooms.index', compact('rooms'));
        }
        public function update(Request $request, Room $room)
        {
            // AUTHORIZATION: Ensure the logged-in agent owns the room they are trying to edit.
            if ($room->agent_id !== Auth::user()->agent->id) {
                abort(403, 'Unauthorized Action');
            }

            // VALIDATION: Validate the incoming data.
            $validated = $request->validate([
                // The 'unique' rule must ignore the current room's ID to avoid errors.
                'room_number' => ['required', 'string', 'max:255', Rule::unique('rooms')->ignore($room->id)->where('property_id', $room->property_id)],
                'description' => ['nullable', 'string'],
                'rent'        => ['required', 'numeric', 'min:0'],
                'capacity'    => ['required', 'integer', 'min:1'],
            ]);

            // Add the 'is_available' status based on whether the checkbox was checked
            $validated['is_available'] = $request->has('is_available');

            // UPDATE: Save the changes to the database.
            $room->update($validated);

            // REDIRECT: Go back with a success message.
            return redirect()->route('agent.dashboard')->with('success', 'Room details updated successfully!')->with('active_section', 'rooms');
        }
}


   