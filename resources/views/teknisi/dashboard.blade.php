
@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('navbar')
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body w-100" data-bs-theme="dark"">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><b>Teknisi</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Edit Profile</a></li>
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
            <h1>Welcome, Teknisi!</h1>
            <p>This is your dashboard where you can manage your application.</p>
            <!-- Add more dashboard content here -->
        </div>
    </div>
</div>
@endsection