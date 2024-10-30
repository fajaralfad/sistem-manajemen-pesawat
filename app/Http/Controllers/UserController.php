<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Menampilkan form tambah pengguna
    public function create()
    {
        return view('admin.users.create');
    }

    // Simpan pengguna baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string',
            'password' => 'required|string|min:8'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User added successfully');
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'role' => 'required|string'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    // Hapus pengguna
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
