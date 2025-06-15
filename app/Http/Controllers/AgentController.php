<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    //
    public function dashboard(){
              
        $properties = Property::all();
        $rooms = Room::all();
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
