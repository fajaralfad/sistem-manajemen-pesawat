<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JadwalPemeliharaanPesawat;
use App\Models\Pesawat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        // Hitung jumlah teknisi aktif
        $activeTechnicians = User::where('role', 'teknisi')->count();

        // Hitung jumlah manajer aktif
        $activeManagers = User::where('role', 'manager')->count();

        return view('admin.dashboard', compact('activeTechnicians', 'activeManagers'));
    }

    public function managerDashboard()
    {
        // Hitung jumlah teknisi aktif
        $activeTechnicians = User::where('role', 'teknisi')->count();

        // Hitung jumlah total pesawat di database
        $activePlanes = Pesawat::count();

        // Hitung jumlah jadwal aktif
        $activeSchedules = JadwalPemeliharaanPesawat::whereIn('status', ['scheduled', 'in_progress'])->count();

        return view('manager.dashboard', compact('activeTechnicians', 'activePlanes', 'activeSchedules'));
    }

    public function teknisiDashboard()
    {
        // Hitung jumlah jadwal aktif
        $activeSchedules = JadwalPemeliharaanPesawat::whereIn('status', ['scheduled', 'in_progress'])->count();

        return view('teknisi.dashboard', compact('activeSchedules'));
    }
}
