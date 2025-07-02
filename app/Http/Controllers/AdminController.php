<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Agent;
use App\Models\Room;
use App\Models\NextOfKin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::where('role', '!=', 'admin')->paginate(10, ['*'], 'users_page');
        $properties = Property::withCount('rooms')->latest()->get(); // <-- ADD withCount('rooms')

        $bookings = Booking::with(['student.user', 'room.property'])->latest()->get();
        $reviews = Review::with(['booking.room.property', 'booking.student.user'])->latest()->get();
        $nextOfKinDetails = NextOfKin::with('student.user')->latest()->get();
       

        // === 1. DATA FOR STATISTIC CARDS ===
        $userCount = User::count();
        $propertyCount = Property::count();
        $roomCount = Room::count();
        $reviewCount = Review::count();
        $bookingCount = Booking::count();

        // === 2. DATA FOR GRAPHS ===

        // Users Graph: Count of 'student' vs 'agent'
        $userRoleData = User::select('role', DB::raw('count(*) as count'))
            ->whereIn('role', ['student', 'agent'])
            ->groupBy('role')
            ->get();

        // Properties Graph: Number of rooms per property (Top 10)
        $propertiesWithRoomCount = Property::withCount('rooms')
            ->orderBy('rooms_count', 'desc')
            ->take(10) // Take top 10 to keep the graph readable
            ->get();

        // Rooms Graph: Count of available vs. unavailable rooms
        $roomStatusData = Room::select('is_available', DB::raw('count(*) as count'))
            ->groupBy('is_available')
            ->get()
            ->map(function ($status) {
                // Make the label more readable
                $status->label = $status->is_available ? 'Available' : 'Unavailable';
                return $status;
            });
            
        // Reviews Graph: Number of reviews per property (Top 10)
        $allPropertiesWithReviews = Property::whereHas('reviews')
            ->withCount('reviews')
            ->get();
            
         $reviewsByProperty = Property::whereHas('reviews')
            ->withCount('reviews')
            ->orderBy('reviews_count', 'desc')
            ->take(10)
            ->get()
            ->map(fn($p) => ['label' => $p->name, 'value' => $p->reviews_count]);    

        // Step 2: Sort the results in PHP and take the top 10.
        $propertiesWithReviewCount = $allPropertiesWithReviews
            ->sortByDesc('reviews_count')
            ->take(10);

        $bookingsByStatus = Booking::select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->get();
        

        // Graph 2: Get the booking count for each property (Top 10)
        $bookingsByProperty = Property::withCount('bookings')
            ->whereHas('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(10)
            ->get()
             ->map(fn($p) => ['label' => $p->name, 'value' => $p->bookings_count]);    



        // === 3. PASS ALL DATA TO THE VIEW ===
        return view('admin.dashboard', [
            // Data for Stat Cards
            'userCount' => $userCount,
            'propertyCount' => $propertyCount,
            'roomCount' => $roomCount,
            'reviewCount' => $reviewCount,
            'bookingCount' => $bookingCount,

            // Data for Graphs
            'userRoleData' => $userRoleData,
            'propertiesWithRoomCount' => $propertiesWithRoomCount,
            'roomStatusData' => $roomStatusData,
            'propertiesWithReviewCount' => $propertiesWithReviewCount,
            'bookingsByStatus' => $bookingsByStatus,       // <-- ADD THIS
            'bookingsByProperty' => $bookingsByProperty,
            'reviewsByProperty' => $reviewsByProperty,
            'allPropertiesWithReviews' => $allPropertiesWithReviews,

            // Other data for the dashboard
             'users' => $users,  
            'properties' => $properties,
            'bookings' => $bookings,
            'reviews' => $reviews,
            'nextOfKinDetails' => $nextOfKinDetails,
            
        ]);
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
            'phone_number' => ['required_if:role,agent', 'nullable', 'string', 'max:20'],
            'license_number' => ['required_if:role,agent', 'nullable', 'string', 'max:255', 'unique:agents,license_number'],

        ]);

        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
         // If the user's role is 'agent', create the agent profile
        if ($request->role === 'agent') {
            try {
                    Agent::create([
                        'user_id' => $user->id, // This line will now work correctly.
                        'phone_number' => $request->phone_number,
                        'license_number' => $request->license_number,
                    ]);
                } catch (\Exception $e) {
                    // This will catch any database errors during agent creation
                    dd($e->getMessage());
                }
        }
        // Redirect back to the user management page with a success message
        return redirect()->route('admin.dashboard')->with('success', 'User created successfully.');
    }
    
     public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|in:student,agent,admin',
        ]);

        $user->update($validatedData);

        return redirect()->back()->with('success', 'User updated successfully!');
    }
    public function destroy(User $user)
    {
       $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }
    public function manageProperties()
    {
        $userCount = \App\Models\User::count();
    $propertyCount = \App\Models\Property::count();
    $roomCount = \App\Models\Room::count();
    $reviewCount = \App\Models\Review::count();
    $bookingCount = \App\Models\Booking::count();
    $bookings = \App\Models\Booking::with(['room', 'student.user'])->latest()->take(5)->get();
    $reviews = Review::with(['booking.room.property', 'booking.student.user'])->latest()->get();
    $nextOfKinDetails = NextOfKin::with('student.user')->latest()->get();
     // Users Graph: Count of 'student' vs 'agent'
        $userRoleData = User::select('role', DB::raw('count(*) as count'))
            ->whereIn('role', ['student', 'agent'])
            ->groupBy('role')
            ->get();

        // Properties Graph: Number of rooms per property (Top 10)
        $propertiesWithRoomCount = Property::withCount('rooms')
            ->orderBy('rooms_count', 'desc')
            ->take(10) // Take top 10 to keep the graph readable
            ->get();

        // Rooms Graph: Count of available vs. unavailable rooms
        $roomStatusData = Room::select('is_available', DB::raw('count(*) as count'))
            ->groupBy('is_available')
            ->get()
            ->map(function ($status) {
                // Make the label more readable
                $status->label = $status->is_available ? 'Available' : 'Unavailable';
                return $status;
            });
            
        // Reviews Graph: Number of reviews per property (Top 10)
        $allPropertiesWithReviews = Property::whereHas('reviews')
            ->withCount('reviews')
            ->get();
            
         $reviewsByProperty = Property::whereHas('reviews')
            ->withCount('reviews')
            ->orderBy('reviews_count', 'desc')
            ->take(10)
            ->get()
            ->map(fn($p) => ['label' => $p->name, 'value' => $p->reviews_count]);    

        // Step 2: Sort the results in PHP and take the top 10.
        $propertiesWithReviewCount = $allPropertiesWithReviews
            ->sortByDesc('reviews_count')
            ->take(10);

        $bookingsByStatus = Booking::select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->get();
        

        // Graph 2: Get the booking count for each property (Top 10)
        $bookingsByProperty = Property::withCount('bookings')
            ->whereHas('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(10)
            ->get()
             ->map(fn($p) => ['label' => $p->name, 'value' => $p->bookings_count]); 

    
    // Fetch data for the tables
    $properties = \App\Models\Property::withCount('rooms')->latest()->get();
    $users = \App\Models\User::latest()->take(5)->get(); // Example: get latest 5 users

    // Return the view with all the required data
    return view('admin.dashboard', [
        'userCount'     => $userCount,
        'propertyCount' => $propertyCount,
        'roomCount'     => $roomCount,
        'reviewCount'   => $reviewCount,
        'bookingCount'  => $bookingCount,
        'properties'    => $properties,
        'users'         => $users,
        'bookings'      => $bookings,
        'reviews'      => $reviews,
        'nextOfKinDetails' => $nextOfKinDetails,
        'userRoleData' => $userRoleData,
        'propertiesWithRoomCount' => $propertiesWithRoomCount,
        'roomStatusData' => $roomStatusData,
        'propertiesWithReviewCount' => $propertiesWithReviewCount,
        'bookingsByStatus' => $bookingsByStatus,       // <-- ADD THIS
        'bookingsByProperty' => $bookingsByProperty,
        'reviewsByProperty' => $reviewsByProperty,
        'allPropertiesWithReviews' => $allPropertiesWithReviews,
        // Add any other variables your dashboard charts might need
    ]);

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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], 
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
            'image' => $request->hasFile('image') ? $request->file('image')->store('property_images', 'public') : null, // Store the image if provided
            'status' => $request->status,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Redirect back to the property management page with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Property created successfully.');
    }
    public function editProperty(Property $property)
    {
        
    
    }
    public function updateProperty(Request $request, Property $property)
    {
        // 1. Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:Apartment,House,Hostel,Studio',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Optional image upload
            'status' => 'required|string|in:available,full,under_maintenance',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);
        if ($request->hasFile('image')) {
        // Optional: Delete the old image if it exists
        if ($property->image) {
            Storage::disk('public')->delete($property->image);
        }

        // Store the new image and get its path
        $path = $request->file('image')->store('property_images', 'public');
        $validated['image'] = $path; // Add the new path to the data to be updated
    }

        // 2. Update the property with the validated data
        $property->update($validatedData);

        // 3. Redirect back to the properties list with a success message
        return redirect()->route('admin.properties')
                         ->with('success', 'Property updated successfully.');
    }
    public function deleteProperty(Property $property)
    {
        // Laravel automatically finds the property. We just delete it.
        $property->delete();

        // Redirect back to the properties list with a success message
        return redirect()->route('admin.properties')
                         ->with('success', 'Property deleted successfully.');
    }


    public function destroyBooking(Booking $booking)
        {
            $booking->delete();

            return redirect()->route('admin.dashboard')
                            ->with('success', 'Booking has been successfully deleted.')
                            ->with('active_section', 'bookings'); // To re-open the bookings tab
        }

        public function destroyReview(Review $review)
            {
                $review->delete();

                return redirect()->route('admin.dashboard')
                                ->with('success', 'Review has been successfully deleted.')
                                ->with('active_section', 'reviews'); // To re-open the reviews tab
            }

        public function getPropertyRooms(Property $property)
        {
            // Eager load the agent and their user details for each room
            $rooms = $property->rooms()->with('agent.user')->get();

            // Also pass back the property name for the modal title
            return response()->json([
                'property_name' => $property->name,
                'rooms' => $rooms
            ]);
        }

}