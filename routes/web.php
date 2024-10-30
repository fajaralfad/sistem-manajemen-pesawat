<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Role-based routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('admin/teknisi', function () {
        return view('admin.teknisi');
    })->name('admin.teknisi');
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.index');
    Route::post('admin/users', [UserController::class, 'store'])->name('admin.store');
    Route::put('admin/users/{id}', [UserController::class, 'update'])->name('admin.update');
    Route::delete('admin/users/{id}', [UserController::class, 'destroy'])->name('admin.destroy');
});

Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('manager/dashboard', function () {
        return view('manager.dashboard');
    })->name('manager.dashboard');
});

Route::middleware(['auth', 'role:teknisi'])->group(function () {
    Route::get('teknisi/dashboard', function () {
        return view('teknisi.dashboard');
    })->name('teknisi.dashboard');
});