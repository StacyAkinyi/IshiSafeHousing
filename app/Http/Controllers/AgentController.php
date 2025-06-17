<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Room;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    //
    public function dashboard(){
              
        $properties = Property::all();
        $rooms = Room::with('property')->get(); // Fetch all rooms with their associated properties
        $bookings = Booking::latest()->get(); // Get latest bookings
        $reviews = Review::all();
        // Fetches all users from the database
        return view('agent.dashboard', [
            
            'properties' => $properties,
            'rooms' => $rooms,
            'bookings' => $bookings,
            'reviews' => $reviews,]); 
    }
}
