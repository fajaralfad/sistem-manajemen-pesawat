@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('navbar')
    @include('layouts.navbar-manager')
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
