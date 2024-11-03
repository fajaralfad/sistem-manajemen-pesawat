<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $teknisiCount = User::where('role', 'teknisi')->count();
        $managerCount = User::where('role', 'manager')->count();
        return view('admin.dashboard', compact('teknisiCount','managerCount'));
    }
}
