@extends('layouts.app')

@section('title', 'Admin Teknisi')
@section('navbar')
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body w-100" data-bs-theme="dark"">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><b>Admin</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="teknisi">Teknisi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pesawat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Manager</a>
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
    <div class="d-flex">
        <div class="content w-100">
            
        </div>
    </div>

@endsection