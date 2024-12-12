@extends('layouts.app')

@section('title', 'Riwayat Teknisi')
@section('navbar')
    @include('layouts.navbar-manager')
@endsection

@section('content')
<div class="container mt-4">
    <h1>Riwayat Teknisi</h1>
    <div class="table-responsive">
        <table id="usersTable" class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Id Dokumentasi</th>
                    <th>Nama Pesawat</th>
                    <th>Jadwal perbaikan</th>
                    <th>Waktu perbaikan</th>
                    <th>Lokasi perbaikan</th>
                    <th>Jenis Perbaikan</th>
                    <th>Gambar dokumentasi</th>
                    <th>Kerusakan</th>
                    <th>Status</th>
                    <th>Laporan</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach($documentations as $documentation)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $documentation->id_dokumentasi}}</td>
                        <td>{{ $documentation->pesawat->nama_maskapai }}</td>
                        <td>{{$documentation->jadwal_perbaikan}}</td>
                        <td>{{$documentation->waktu_perbaikan}}</td>
                        <td>{{ $documentation->lokasiPerbaikan->lokasi }}</td>
                        <td>{{ $documentation->jenis_perbaikan }}</td>
                        <td><img src="{{ asset('storage/' . $documentation->gambar_dokumentasi) }}" alt="Gambar Dokumentasi" width="100"></td>
                        <td>{{ $documentation->kerusakan }}</td>
                        <td>{{ $documentation->status_perbaikan }}</td>
                        <td>{{ $documentation->laporan }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection