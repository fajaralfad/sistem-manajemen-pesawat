<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Show the form for editing the admin profile.
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('admin.edit-profile', compact('user'));
    }

    /**
     * Update the admin profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['required', 'string'],
            'password' => ['nullable', 'string', 'confirmed'],
        ]);
    
        // Check if current password matches the one in the database
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password you entered is incorrect.']);
        }
    
        // If a new password is provided, update it
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Update the user's name and email
        $user->name = $request->name;
        $user->email = $request->email;
    
        // Save the updated user
        $user->save();
    
        return back()->with('success', 'Your profile has been updated successfully.');
    }
}
