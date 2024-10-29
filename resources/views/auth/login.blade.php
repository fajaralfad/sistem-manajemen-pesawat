@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    body {
        background: url('{{ asset('images/airplane-bg.jpg') }}') no-repeat center center fixed;
        background-size: cover;
    }
    .card {
        background-color: rgba(255, 255, 255, 0.8);
    }
</style>
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card" style="width: 50rem;">
        <div class="card-body">
            <h1 class="card-title text-center"><i data-feather="user" width="48" height="48"></i> <br><b>Login</b> </h1>
            <hr>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary w-50">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection