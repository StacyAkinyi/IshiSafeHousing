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

            dd($availableRooms->toArray());

        return response()->json([
            'property_name' => $property->name,
            'rooms' => $availableRooms
        ]);
    }
}
