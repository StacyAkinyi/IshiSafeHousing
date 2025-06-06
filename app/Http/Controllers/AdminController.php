<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // <-- Add this import for password hashing
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function dashboard()
    {
        
        return view('admin.dashboard');
    }
    public function manageUsers()
    {
        $users = User::all(); // Fetches all users from the database
        return view('admin.users', ['users' => $users]); // Pass the users to the view
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
        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }
}

