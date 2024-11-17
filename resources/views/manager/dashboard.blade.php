@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
    <div class="container-fluid">
        <!-- Logo / Brand -->
        <a class="navbar-brand" href="{{ route('manager.dashboard') }}"><b>Manager</b></a>
        
        <!-- Toggler button for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Collapsible menu -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <!-- Jadwal Pemeliharaan -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('manager.jadwal.index') ? 'active' : '' }}" href="{{ route('manager.jadwal.index') }}">Jadwal Pemeliharaan</a>
                </li>

                <!-- Riwayat Teknisi -->
                <li class="nav-item">
                    <a class="nav-link" href="#">Riwayat Teknisi</a>
                </li>

                <!-- Dropdown for User Profile -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('manager.profile.edit') }}">Edit Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endsection

@section('content')
<style>
    body {
        background: url('{{ asset('images/bg-dashboard.png') }}') no-repeat center center fixed;
        background-size: cover;
    }
    .card {
        background-color: rgba(255, 255, 255, 0.8);
    }
</style>

<div class="d-flex">
    <div class="content w-100">
        <div class="container mt-4">
            <h1>Welcome, Manager!</h1>
            <p>This is your dashboard where you can manage your application.</p>
            <div class="row">
                <!-- Active Technician Card -->
                <div class="card m-4 text-white bg-primary" style="width: 23rem;">
                    <div class="card-body">
                        <h5 class="card-title"><b>Active Technician</b></h5>
                        <i data-feather="users" width="98" height="98"></i>
                        <h2>{{ $activeTechnicians }}</h2>
                    </div>
                </div>
                <!-- Active Plane Card -->
                <div class="card m-4 text-white bg-success" style="width: 23rem;">
                    <div class="card-body">
                        <h5 class="card-title"><b>Active Plane</b></h5>
                        <i data-feather="send" width="98" height="98"></i>
                        <h2>{{ $activePlanes }}</h2>
                    </div>
                </div>
                <!-- Active Plane Schedule Card -->
                <div class="card m-4 text-white bg-warning" style="width: 23rem;">
                    <div class="card-body">
                        <h5 class="card-title"><b>Active Plane Schedule</b></h5>
                        <i data-feather="book-open" width="98" height="98"></i>
                        <h2>{{ $activeSchedules }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
