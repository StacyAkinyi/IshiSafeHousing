<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all(); 
        $properties = Property::latest()->get();
        $bookings = Booking::all(); // Get latest bookings
        $reviews = Review::all();
        // Fetches all users from the database
        return view('admin.dashboard', [
            'users' => $users,  
            'properties' => $properties,
            'bookings' => $bookings,
            'reviews' => $reviews,]); // Pass the users to the view
    }
    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    /**
     * Store a newly created user in storage.
     */
    public function storeUser(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string', 'in:student,agent,admin'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create the new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);


        // Redirect back to the user management page with a success message
        return redirect()->route('admin.dashboard')->with('success', 'User created successfully.');
    }
    public function manageProperties()
    {
        $properties = Property::latest()->get(); 
        return view('admin.properties', ['properties' => $properties]);
    }
    public function storeProperty(Request $request)
    {
        
        // Validate the incoming request data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:Apartment,Hostel,House,Studio'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'status' => ['required', 'string', 'in:available,full,under_maintenance'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
        ]);

        // Create the new property
        Property::create([
            'name' => $request->name,
            'type' => $request->type,
            'address' => $request->address,
            'city' => $request->city,
            'description' => $request->description,
            'status' => $request->status,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Redirect back to the property management page with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Property created successfully.');
    }

}