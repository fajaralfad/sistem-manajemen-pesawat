@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('navbar')
    @include('layouts.navbar-admin')
@endsection

@section('content')
<div class="d-flex">
    <div class="content w-100">
        <div class="container mt-4">
            <h1>Welcome, Admin!</h1>
            <p>This is your dashboard where you can manage your application.</p>
            <div class="row">
                <div class="card m-4 text-white bg-primary" style="width: 23rem;">
                    <div class="card-body">
                        <h5 class="card-title"><b>Active Technician</b></h5>
                        <i data-feather="users" width="98" height="98"></i>
                        <h2>{{ $activeTechnicians }}</h2>
                    </div>
                </div>
                <div class="card m-4 text-white bg-warning" style="width: 23rem;">
                    <div class="card-body">
                        <h5 class="card-title"><b>Active Manager</b></h5>
                        <i data-feather="user" width="98" height="98"></i>
                        <h2>{{ $activeManagers }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
