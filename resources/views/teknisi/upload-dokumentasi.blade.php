@extends('layouts.app')

@section('title', 'Teknisi Dashboard')
@section('navbar')
    @include('layouts.navbar-teknisi')
@endsection
@section('content')

<div class="container mt-5">
    <h2 class="text-center">Upload Dokumentasi Pesawat</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol untuk membuka modal -->
    <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#uploadModal"><i data-feather="list"></i> Upload Dokumentasi</button>

    <!-- Modal untuk upload dokumentasi -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Dokumentasi Pesawat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('save-documentation') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="jadwal_perbaikan">Jadwal perbaikan:</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="date" class="form-control" id="jadwal_perbaikan" name="jadwal_perbaikan" required>
                                </div>
                                <div class="col-6">
                                    <input type="time" class="form-control" id="waktu_perbaikan" name="waktu_perbaikan" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="gambar_dokumentasi">Gambar dokumentasi:</label>
                            <input type="file" class="form-control" id="gambar_dokumentasi" name="gambar_dokumentasi" required>
                        </div>

                        <div class="form-group">
                            <label for="kerusakan">Kategori Kerusakan:</label>
                            <select class="form-control" id="kerusakan" name="kerusakan" required>
                                <option value="kecil">Kecil</option>
                                <option value="sedang">Sedang</option>
                                <option value="parah">Parah</option>
                                <option value="sangat_parah">Sangat Parah</option>
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label for="jenis_perbaikan">Jenis Perbaikan:</label>
                            <input type="text" class="form-control" id="jenis_perbaikan" name="jenis_perbaikan" required>
                        </div>

                        <div class="form-group mt-2">
                            <label for="lokasi_perbaikan">Lokasi Perbaikan:</label>
                            <select class="form-control" id="lokasi_perbaikan" name="lokasi_perbaikan" required>
                                <option value="" disabled selected>Pilih Lokasi Perbaikan</option>
                                @foreach($lokasiPerbaikanList as $lokasi)
                                    <option value="{{ $lokasi->lokasi }}">{{ $lokasi->lokasi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status_perbaikan">Status:</label>
                            <select class="form-control" id="status_perbaikan" name="status_perbaikan" required>
                                <option value="kecil">Kecil</option>
                                <option value="sedang">Sedang</option>
                                <option value="parah">Parah</option>
                                <option value="sangat_parah">Sangat Parah</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="laporan">Laporan:</label>
                            <textarea class="form-control" id="laporan" name="laporan" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Dokumentasi -->
    <h3 class="mt-5">Daftar Dokumentasi Pesawat</h3>

    <div class="table-responsive">
        <table id="usersTable" class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Id Dokumentasi</th>
                    <th>Jadwal perbaikan</th>
                    <th>Waktu perbaikan</th>
                    <th>Lokasi perbaikan</th>
                    <th>Jenis Perbaikan</th>
                    <th>Gambar dokumentasi</th>
                    <th>Kerusakan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documentations as $documentation)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $documentation->id_dokumentasi}}</td>
                        <td>{{$documentation->jadwal_perbaikan}}</td>
                        <td>{{$documentation->waktu_perbaikan}}</td>
                        <td>{{ $documentation->lokasi_perbaikan }}</td>
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

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection