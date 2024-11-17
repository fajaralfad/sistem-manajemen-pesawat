@extends('layouts.app')

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('manager.dashboard') }}"><b>Manager</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('manager.jadwal.index') ? 'active' : '' }}" href="{{ route('manager.jadwal.index') }}">Jadwal Pemeliharaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Riwayat Teknisi</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
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
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-6">Edit Jadwal Pemeliharaan</h1>
        <a href="{{ route('manager.jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('manager.jadwal.update', $jadwal->id_jadwal_pemeliharaan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="id_pesawat" class="form-label">Pesawat</label>
                    <select name="id_pesawat" id="id_pesawat" class="form-select" required>
                        <option value="">Pilih Pesawat</option>
                        @foreach($pesawat as $item)
                            <option value="{{ $item->id_pesawat }}" {{ $jadwal->id_pesawat == $item->id_pesawat ? 'selected' : '' }}>
                                {{ $item->nama_maskapai }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jadwal_pemeliharaan" class="form-label">Jadwal Pemeliharaan</label>
                    <input type="date" name="jadwal_pemeliharaan" id="jadwal_pemeliharaan" class="form-control" value="{{ $jadwal->jadwal_pemeliharaan }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required>{{ $jadwal->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="scheduled" {{ $jadwal->status == 'scheduled' ? 'selected' : '' }}>scheduled</option>
                        <option value="in_progress" {{ $jadwal->status == 'in_progress' ? 'selected' : '' }}>in_progress</option>
                        <option value="completed" {{ $jadwal->status == 'completed' ? 'selected' : '' }}>completed</option>
                        <option value="cancelled" {{ $jadwal->status == 'cancelled' ? 'selected' : '' }}>cancelled</option>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
