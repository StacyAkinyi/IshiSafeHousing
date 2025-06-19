<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
     public function index()
    {
        $user = Auth::user()->load('nextOfKin');
        return view('student.account', compact('user'));
    }

    /**
     * Update the user's personal details.
     */
    public function updateDetails(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone_number' => ['nullable', 'string', 'max:20'],
        ]);

        $user->update($validatedData);

        return redirect()->route('student.account.index')->with('success', 'Personal details updated successfully.');
    }

    /**
     * Create or update the user's next of kin details.
     */
    public function updateNextOfKin(Request $request)
    {
        $validatedData = $request->validate([
            'kin_name' => ['required', 'string', 'max:255'],
            'kin_relationship' => ['required', 'string', 'max:255'],
            'kin_phone_number' => ['required', 'string', 'max:20'],
            'kin_email' => ['nullable', 'string', 'email', 'max:255'],
        ]);

        Auth::user()->nextOfKin()->updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => $validatedData['kin_name'],
                'relationship' => $validatedData['kin_relationship'],
                'phone_number' => $validatedData['kin_phone_number'],
                'email' => $validatedData['kin_email'],
            ]
        );

        return redirect()->route('student.account.index')->with('success', 'Next of kin details updated successfully.');
    }
}
