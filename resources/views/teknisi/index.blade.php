@extends('layouts.app')

@section('title', 'teknisi Dashboard')
@section('navbar')

@section('content')

    <div class="container mt-5">
        <h2 class="text-center">Daftar Dokumentasi Pesawat</h2>

        <!-- Tabel Daftar Dokumentasi -->
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No Registrasi Pesawat</th>
                    <th>File Dokumentasi</th>
                    <th>Tanggal Upload</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                    <tr>
                        <td>{{ $document->aircraft_id }}</td>
                        <td><a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">Lihat File</a></td>
                        <td>{{ $document->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
