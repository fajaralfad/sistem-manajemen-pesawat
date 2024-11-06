@extends('layouts.app')

@section('title', 'Edit Pesawat')
@section('navbar')
    @include('layouts.navbar-admin')
@endsection

@section('content')
<div class="d-flex">
    <div class="content w-100">
        <div class="container mt-4">
            <h2>Edit Pesawat</h2>
            <hr>

            <form method="POST" action="{{ route('admin.pesawat.update', $pesawat->id_pesawat) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- No Registrasi -->
                <div class="mb-3">
                    <label for="no_registrasi" class="form-label">No Registrasi</label>
                    <input type="text" name="no_registrasi" class="form-control" value="{{ $pesawat->no_registrasi }}" placeholder="Contoh: PK-XYZ" required>
                </div>

                <!-- Nama Maskapai -->
                <div class="mb-3">
                    <label for="nama_maskapai" class="form-label">Nama Maskapai</label>
                    <input type="text" name="nama_maskapai" class="form-control" value="{{ $pesawat->nama_maskapai }}" required>
                </div>

                <!-- Gambar Maskapai -->
                <div class="mb-3">
                    <label for="gambar_maskapai" class="form-label">Gambar Maskapai</label>
                    <input type="file" name="gambar_maskapai" class="form-control" accept="image/*">
                    @if($pesawat->gambar_maskapai)
                        <img src="{{ asset('storage/' . $pesawat->gambar_maskapai) }}" alt="Maskapai Image" width="100" class="mt-2">
                    @endif
                </div>

                <!-- Tipe Pesawat -->
                <div class="mb-3">
                    <label for="tipe_pesawat" class="form-label">Tipe Pesawat</label>
                    <select name="tipe_pesawat" class="form-select" required>
                        <option value="" disabled>Pilih Tipe Pesawat</option>
                        <option value="Boeing 737" {{ $pesawat->tipe_pesawat == 'Boeing 737' ? 'selected' : '' }}>Boeing 737</option>
                        <option value="Airbus A320" {{ $pesawat->tipe_pesawat == 'Airbus A320' ? 'selected' : '' }}>Airbus A320</option>
                        <option value="Boeing 747" {{ $pesawat->tipe_pesawat == 'Boeing 747' ? 'selected' : '' }}>Boeing 747</option>
                        <option value="Embraer E190" {{ $pesawat->tipe_pesawat == 'Embraer E190' ? 'selected' : '' }}>Embraer E190</option>
                        <option value="Bombardier CRJ700" {{ $pesawat->tipe_pesawat == 'Bombardier CRJ700' ? 'selected' : '' }}>Bombardier CRJ700</option>
                    </select>
                </div>

                <!-- Jenis Pesawat -->
                <div class="mb-3">
                    <label for="jenis_pesawat" class="form-label">Jenis Pesawat</label>
                    <select name="jenis_pesawat" class="form-select" required>
                        <option value="" disabled>Pilih Jenis Pesawat</option>
                        <option value="Penumpang" {{ $pesawat->jenis_pesawat == 'Penumpang' ? 'selected' : '' }}>Penumpang</option>
                        <option value="Kargo" {{ $pesawat->jenis_pesawat == 'Kargo' ? 'selected' : '' }}>Kargo</option>
                        <option value="Pribadi" {{ $pesawat->jenis_pesawat == 'Pribadi' ? 'selected' : '' }}>Pribadi</option>
                    </select>
                </div>

                <!-- Kapasitas Penumpang -->
                <div class="mb-3">
                    <label for="kapasitas_penumpang" class="form-label">Kapasitas Penumpang</label>
                    <input type="number" name="kapasitas_penumpang" class="form-control" value="{{ $pesawat->kapasitas_penumpang }}" min="1" required>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                <a href="{{ route('pesawat.index') }}" class="btn btn-secondary mt-3">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
