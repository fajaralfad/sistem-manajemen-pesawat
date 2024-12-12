@extends('layouts.app')

@section('title', 'Edit Dokumentasi')
@section('navbar')
    @include('layouts.navbar-teknisi')
@endsection
@section('content')

<div class="container mt-5">
    <h2 class="text-center">Edit Dokumentasi Pesawat</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('document.update', $documentation->id_dokumentasi) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mt-2">
            <label for="pesawat_id">Nama Pesawat:</label>
            <select class="form-control" id="pesawat_id" name="pesawat_id" required>
                <option value="" disabled>Pilih Nama Pesawat</option>
                @foreach($pesawatList as $pesawat)
                    <option value="{{ $pesawat->id_pesawat }}" {{ $documentation->pesawat_id == $pesawat->id_pesawat ? 'selected' : '' }}>{{ $pesawat->nama_maskapai }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <label for="jadwal_perbaikan">Jadwal perbaikan:</label>
            <div class="row">
                <div class="col-6">
                    <input type="date" class="form-control" id="jadwal_perbaikan" name="jadwal_perbaikan" value="{{ $documentation->jadwal_perbaikan }}" required>
                </div>
                <div class="col-6">
                    <input type="time" class="form-control" id="waktu_perbaikan" name="waktu_perbaikan" value="{{ $documentation->waktu_perbaikan }}" required>
                </div>
            </div>
        </div>

        <div class="form-group mt-2">
            <label for="gambar_dokumentasi">Gambar dokumentasi:</label>
            <input type="file" class="form-control" id="gambar_dokumentasi" name="gambar_dokumentasi">
            @if($documentation->gambar_dokumentasi)
                <img src="{{ asset('storage/' . $documentation->gambar_dokumentasi) }}" alt="Gambar Dokumentasi" width="100" class="mt-2">
            @endif
        </div>

        <div class="form-group">
            <label for="kerusakan">Kategori Kerusakan:</label>
            <select class="form-control" id="kerusakan" name="kerusakan" required>
                <option value="kecil" {{ $documentation->kerusakan == 'kecil' ? 'selected' : '' }}>Kecil</option>
                <option value="sedang" {{ $documentation->kerusakan == 'sedang' ? 'selected' : '' }}>Sedang</option>
                <option value="parah" {{ $documentation->kerusakan == 'parah' ? 'selected' : '' }}>Parah</option>
                <option value="sangat_parah" {{ $documentation->kerusakan == 'sangat_parah' ? 'selected' : '' }}>Sangat Parah</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label for="jenis_perbaikan">Jenis Perbaikan:</label>
            <input type="text" class="form-control" id="jenis_perbaikan" name="jenis_perbaikan" value="{{ $documentation->jenis_perbaikan }}" required>
        </div>

        <div class="form-group mt-2">
            <label for="lokasi_perbaikan">Lokasi Perbaikan:</label>
            <select class="form-control" id="lokasi_perbaikan" name="lokasi_perbaikan_id" required>
                <option value="" disabled>Pilih Lokasi Perbaikan</option>
                @foreach($lokasiPerbaikanList as $lokasi)
                    <option value="{{ $lokasi->id }}" {{ $documentation->lokasi_perbaikan_id == $lokasi->id ? 'selected' : '' }}>{{ $lokasi->lokasi }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status_perbaikan">Status:</label>
            <select class="form-control" id="status_perbaikan" name="status_perbaikan" required>
                <option value="pending" {{ $documentation->status_perbaikan == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="on_progress" {{ $documentation->status_perbaikan == 'on_progress' ? 'selected' : '' }}>On Progress</option>
                <option value="selesai" {{ $documentation->status_perbaikan == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="kesalahan" {{ $documentation->status_perbaikan == 'kesalahan' ? 'selected' : '' }}>Kesalahan</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label for="laporan">Laporan:</label>
            <textarea class="form-control" id="laporan" name="laporan" required>{{ $documentation->laporan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>

@endsection