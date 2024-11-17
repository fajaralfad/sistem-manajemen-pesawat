<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesawatController;
use App\Http\Controllers\JadwalPemeliharaanController;
use Illuminate\Support\Facades\Route;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Routes for Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::get('teknisi', function () {
        return view('admin.teknisi');
    })->name('teknisi');
    Route::get('index', [UserController::class, 'index'])->name('index');
    
    // Pesawat management for admin
    Route::get('pesawat', [PesawatController::class, 'index'])->name('index');
    Route::post('pesawat', [PesawatController::class, 'store'])->name('store');
    Route::get('pesawat/{id}', [PesawatController::class, 'show'])->name('show');
    Route::get('pesawat/{id}/edit', [PesawatController::class, 'edit'])->name('pesawat.edit');
    Route::put('pesawat/{id}', [PesawatController::class, 'update'])->name('pesawat.update');
    Route::delete('pesawat/{id}', [PesawatController::class, 'destroy'])->name('pesawat.destroy');

    
    // User management
    Route::get('users', [UserController::class, 'list'])->name('users');
    Route::post('users', [UserController::class, 'store'])->name('store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    // Dashboard for Manager
    Route::get('dashboard', [DashboardController::class, 'managerDashboard'])->name('dashboard');

    // Jadwal Pemeliharaan routes
    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('/', [JadwalPemeliharaanController::class, 'index'])->name('index'); // List semua jadwal
        Route::get('/create', [JadwalPemeliharaanController::class, 'create'])->name('create'); // Form tambah jadwal baru
        Route::post('/', [JadwalPemeliharaanController::class, 'store'])->name('store'); // Simpan jadwal baru
        Route::get('/{id}', [JadwalPemeliharaanController::class, 'show'])->name('show'); // Detail jadwal tertentu
        Route::get('/{id}/edit', [JadwalPemeliharaanController::class, 'edit'])->name('edit'); // Form edit jadwal
        Route::put('/{id}', [JadwalPemeliharaanController::class, 'update'])->name('update'); // Proses update jadwal
        Route::delete('/{id}', [JadwalPemeliharaanController::class, 'destroy'])->name('destroy'); // Hapus jadwal
    });
});

// Routes for Teknisi
Route::middleware(['auth', 'role:teknisi'])->prefix('teknisi')->name('teknisi.')->group(function () {
    Route::get('dashboard', function () {
        return view('teknisi.dashboard');
    })->name('dashboard');
});

// Pesawat routes (accessible for authenticated users with appropriate role)
// Route untuk halaman daftar pesawat (index)
Route::middleware('auth')->group(function () {
    Route::get('/pesawat', [PesawatController::class, 'index'])->name('pesawat.index');
    Route::post('/pesawat', [PesawatController::class, 'store'])->name('pesawat.store');
});

