<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController ;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesawatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalPemeliharaanController;
use App\Http\Controllers\DocumentController;

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
    Route::get('profile/edit', [AdminController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');

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
    
    Route::get('profile/edit', [ManagerController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile/update', [ManagerController::class, 'updateProfile'])->name('profile.update');

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

    Route::prefix('riwayat-teknisi')->name('riwayat-teknisi.')->group(function () {
        Route::get('/', [ManagerController::class, 'riwayatTeknisi'])->name('index');
        Route::get('/{id}', [ManagerController::class, 'showRiwayatTeknisi'])->name('show');
    });
});

// Routes for Teknisi
Route::middleware(['auth', 'role:teknisi'])->prefix('teknisi')->name('teknisi.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'teknisiDashboard'])->name('dashboard');
    Route::get('upload-dokumentasi', [DocumentController::class, 'create'])->name('upload-dokumentasi');
    Route::get('profile/edit', [TeknisiController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile/update', [TeknisiController::class, 'updateProfile'])->name('profile.update');
});

// Pesawat routes (accessible for authenticated users with appropriate role)
// Route untuk halaman daftar pesawat (index)
Route::middleware('auth')->group(function () {
    Route::get('/pesawat', [PesawatController::class, 'index'])->name('pesawat.index');
    Route::post('/pesawat', [PesawatController::class, 'store'])->name('pesawat.store');
});
//route untuk halaman upload dkumentasi pesawat
// Route untuk halaman upload dokumentasi pesawat
Route::middleware('auth')->group(function () {
    Route::get('/upload-dokumentasi', [DocumentController::class, 'create'])->name('upload-dokumentasi');
    Route::post('/save-documentation', [DocumentController::class, 'store'])->name('save-documentation');
});


Route::post('/upload-dokumentasi', [DocumentController::class, 'store'])->name('document.store');
Route::get('/daftar-dokumentasi', [DocumentController::class, 'index'])->name('daftar-dokumentasi');



