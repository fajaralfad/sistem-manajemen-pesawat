@extends('layouts.app')

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
    <div class="container-fluid">
        <!-- Logo / Brand -->
        <<a class="navbar-brand" href="{{route('manager.dashboard')}}"><b>Manager</b></a>
        
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
        <h1 class="display-6">Daftar Jadwal Pemeliharaan</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createJadwalModal">Tambah Jadwal Baru</button>
    </div>

    <!-- Modal Tambah Jadwal -->
    <div class="modal fade" id="createJadwalModal" tabindex="-1" aria-labelledby="createJadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createJadwalModalLabel">Tambah Jadwal Pemeliharaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('manager.jadwal.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="id_pesawat" class="form-label">Pesawat</label>
                            <select name="id_pesawat" id="id_pesawat" class="form-select" required>
                                <option value="">Pilih Pesawat</option>
                                @foreach($pesawat as $item)
                                    <option value="{{ $item->id_pesawat }}">{{ $item->nama_maskapai }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jadwal_pemeliharaan" class="form-label">Jadwal Pemeliharaan</label>
                            <input type="date" name="jadwal_pemeliharaan" id="jadwal_pemeliharaan" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="scheduled">scheduled</option>
                                <option value="in_progress">in_progress</option>
                                <option value="completed">completed</option>
                                <option value="cancelled">cancelled</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Jadwal Pemeliharaan -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Pesawat</th>
                    <th>Jadwal</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwals as $item)
                <tr>
                    <td>{{ $item->id_jadwal_pemeliharaan }}</td>
                    <td>{{ $item->pesawat->nama_maskapai }}</td>
                    <td>{{ $item->jadwal_pemeliharaan }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td class="text-capitalize">{{ $item->status }}</td>
                    <td>
                        <a href="{{ route('manager.jadwal.show', $item->id_jadwal_pemeliharaan) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('manager.jadwal.edit', $item->id_jadwal_pemeliharaan) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('manager.jadwal.destroy', $item->id_jadwal_pemeliharaan) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
