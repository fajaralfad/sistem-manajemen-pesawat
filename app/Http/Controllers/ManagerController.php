<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\TechnicianHistory;
use App\Models\User;
use App\Models\Document;
use App\Models\LokasiPerbaikan;

class ManagerController extends Controller
{
    /**
     * Show the form for editing the manager profile.
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('manager.edit-profile', compact('user'));
    }

    public function riwayatTeknisi()
    {
        $documentations = Document::with('lokasiPerbaikan', 'pesawat')->get();
        $lokasiPerbaikanList = LokasiPerbaikan::all();
        return view('manager.riwayat-teknisi.index', compact('documentations', 'lokasiPerbaikanList'));
    }

    public function showRiwayatTeknisi($id)
    {
        $documentations = Document::where('id_teknisi', $id)->with('lokasiPerbaikan', 'pesawat')->get();
        $lokasiPerbaikanList = LokasiPerbaikan::all();
        $technician = User::findOrFail($id);
        return view('manager.riwayat-teknisi.index', compact('documentations', 'lokasiPerbaikanList', 'technician'));
    }

    /**
     * Update the manager profile.
     */
    public function updateProfile(Request $request)
{
    $user = Auth::user();

    // Validasi input
    $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        'current_password' => ['required', 'string'],
        'password' => ['nullable', 'string', 'confirmed', 'different:current_password'], // Ensure new password is different
    ]);

    // Periksa apakah password lama sesuai dengan yang ada di database
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'The current password you entered is incorrect.']);
    }

    // Jika password baru diisi, pastikan tidak sama dengan password lama
    if ($request->filled('password')) {
        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'The new password cannot be the same as the current password.']);
        }
        $user->password = Hash::make($request->password);
    }

    // Perbarui nama dan email pengguna
    $user->name = $request->name;
    $user->email = $request->email;

    // Simpan perubahan
    $user->save();

    return back()->with('success', 'Your profile has been updated successfully.');
}
    
}
