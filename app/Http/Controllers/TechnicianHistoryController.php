<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TechnicianHistory;

class TechnicianHistoryController extends Controller
{
    public function index()
    {
        $histories = TechnicianHistory::with(['technician', 'plane'])->get();
        return view('technician-history.index', compact('histories'));
    }
}