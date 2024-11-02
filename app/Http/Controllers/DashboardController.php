<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $activeTechnicians = User::where('role', 'teknisi')->count();
        $activeManagers = User::where('role', 'manager')->count();

        return view('admin.dashboard', compact('activeTechnicians', 'activeManagers'));
    }

    public function managerDashboard()
    {
        $activeTechnicians = User::where('role', 'teknisi')->count();

        return view('manager.dashboard', compact('activeTechnicians'));
    }
}
