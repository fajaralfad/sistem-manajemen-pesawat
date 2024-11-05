@extends('layouts.app')

@section('title', 'Daftar Pesawat')
@section('navbar')
    @include('layouts.navbar-admin')
@endsection

@section('content')
<div class="container mt-4">
    <h1>Daftar Pesawat</h1>

    <!-- Tombol Tambah Pesawat -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPesawatModal">Tambah Pesawat</button>

    <!-- Tabel Pesawat -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No Registrasi</th>
                <th>Nama Maskapai</th>
                <th>Gambar Maskapai</th>
                <th>Tipe Pesawat</th>
                <th>Jenis Pesawat</th>
                <th>Kapasitas Penumpang</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesawatList as $pesawat)
            <tr>
                <td>{{ $pesawat->no_registrasi }}</td>
                <td>{{ $pesawat->nama_maskapai }}</td>
                <td>
                    <img src="{{ asset($pesawat->gambar_maskapai) }}" alt="Gambar Maskapai" width="80">
                </td>
                <td>{{ $pesawat->tipe_pesawat }}</td>
                <td>{{ $pesawat->jenis_pesawat }}</td>
                <td>{{ $pesawat->kapasitas_penumpang }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Pesawat -->
<div class="modal fade" id="addPesawatModal" tabindex="-1" aria-labelledby="addPesawatLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('pesawat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPesawatLabel">Tambah Pesawat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- No Registrasi -->
                    <div class="mb-3">
                        <label for="no_registrasi" class="form-label">No Registrasi</label>
                        <input type="text" name="no_registrasi" class="form-control" placeholder="Contoh: PK-XYZ" required>
                    </div>

                    <!-- Nama Maskapai -->
                    <div class="mb-3">
                        <label for="nama_maskapai" class="form-label">Nama Maskapai</label>
                        <input type="text" name="nama_maskapai" class="form-control" required>
                    </div>

                    <!-- Gambar Maskapai -->
                    <div class="mb-3">
                        <label for="gambar_maskapai" class="form-label">Gambar Maskapai</label>
                        <input type="file" name="gambar_maskapai" class="form-control" accept="image/*" required>
                    </div>

                    <!-- Tipe Pesawat -->
                    <div class="mb-3">
                        <label for="tipe_pesawat" class="form-label">Tipe Pesawat</label>
                        <select name="tipe_pesawat" class="form-select" required>
                            <option value="" disabled selected>Pilih Tipe Pesawat</option>
                            <option value="Boeing 737">Boeing 737</option>
                            <option value="Airbus A320">Airbus A320</option>
                            <option value="Boeing 747">Boeing 747</option>
                            <option value="Embraer E190">Embraer E190</option>
                            <option value="Bombardier CRJ700">Bombardier CRJ700</option>
                        </select>
                    </div>

                    <!-- Jenis Pesawat -->
                    <div class="mb-3">
                        <label for="jenis_pesawat" class="form-label">Jenis Pesawat</label>
                        <select name="jenis_pesawat" class="form-select" required>
                            <option value="" disabled selected>Pilih Jenis Pesawat</option>
                            <option value="Penumpang">Penumpang</option>
                            <option value="Kargo">Kargo</option>
                            <option value="Pribadi">Pribadi</option>
                        </select>
                    </div>

                    <!-- Kapasitas Penumpang -->
                    <div class="mb-3">
                        <label for="kapasitas_penumpang" class="form-label">Kapasitas Penumpang</label>
                        <input type="number" name="kapasitas_penumpang" class="form-control" min="1" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
