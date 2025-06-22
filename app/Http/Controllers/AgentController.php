<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Room;
use App\Models\Agent;

use Illuminate\Support\Facades\Auth;

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
        $reviews = Review::all();
        // Fetches all users from the database
        return view('agent.dashboard', [
            
            'properties' => $properties,
            'rooms' => $rooms,
            'bookings' => $bookings,
            'reviews' => $reviews,]); 
    }
}
