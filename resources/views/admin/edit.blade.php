@extends('layouts.app')

@section('title', 'Admin Teknisi')
@section('navbar')
    @include('layouts.navbar-admin')
@endsection

@section('content')
<div class="d-flex">
    <div class="content w-100">
        <div class="container mt-4">
        <h2>Edit User</h2>
        <hr>

        <form method="POST" action="{{ route('admin.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="manager" {{ $user->role === 'manager' ? 'selected' : '' }}>Manager</option>
                    <option value="teknisi" {{ $user->role === 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Password (leave blank to keep current)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save</button>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
        </div>

      
        
    </div>
</div>
@endsection