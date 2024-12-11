<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }


    // Simpan pengguna baru
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|string|min:3', // Minimum password length
        ]);

        try {
            // Create a new user
            \Log::info('Creating user:', $request->all());
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password), // Hashing the password
            ]);

            // Redirect back with a success message
            return redirect()->route('admin.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'User creation failed: ' . $e->getMessage());
        }
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    // Update pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // If password is provided, hash it and update
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect()->route('admin.index')->with('success', 'User updated successfully.');
    }

    // Hapus pengguna
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.index')->with('success', 'User deleted successfully');
    }
}