<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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

// Role-based routes for Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/teknisi', function () {
        return view('admin.teknisi');
    })->name('admin.teknisi');
    Route::get('admin/index', [UserController::class, 'index'])->name('admin.index');
    Route::get('admin/users', [UserController::class, 'list'])->name('admin.users');
    Route::post('admin/users', [UserController::class, 'store'])->name('admin.store');
    Route::get('admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.edit');
    Route::put('admin/users/{id}', [UserController::class, 'update'])->name('admin.update');
    Route::delete('admin/users/{id}', [UserController::class, 'destroy'])->name('admin.destroy');
});

// Role-based routes for Manager
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('manager/dashboard', function () {
        return view('manager.dashboard');
    })->name('manager.dashboard');
});

Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('manager/dashboard', [DashboardController::class, 'managerDashboard'])->name('manager.dashboard');
});

// Role-based routes for Teknisi
Route::middleware(['auth', 'role:teknisi'])->group(function () {
    Route::get('teknisi/dashboard', function () {
        return view('teknisi.dashboard');
    })->name('teknisi.dashboard');
});
