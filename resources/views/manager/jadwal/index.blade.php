@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar-manager')
@endsection


@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-6"><i data-feather="list" width="50" height="50"></i> Daftar Jadwal Pemeliharaan</h1>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createJadwalModal"><i data-feather="plus" width="20" height="20"></i> Tambah Jadwal Baru</button>
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
        <table id="usersTable" class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Pesawat</th>
                    <th>Jadwal</th>
                    <th>Deskripsi</th>
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
                    <td>
    <a href="{{ route('manager.jadwal.edit', $item->id_jadwal_pemeliharaan) }}" class="btn btn-sm btn-warning">Edit</a>
    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $item->id_jadwal_pemeliharaan }}">Delete</button>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="confirmDeleteModal{{ $item->id_jadwal_pemeliharaan }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{ $item->id_jadwal_pemeliharaan }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel{{ $item->id_jadwal_pemeliharaan }}">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus jadwal pemeliharaan dengan ID <b>{{ $item->id_jadwal_pemeliharaan }}</b> untuk pesawat <b>{{ $item->pesawat->nama_maskapai }}</b>?
                    Data yang sudah dihapus tidak dapat dikembalikan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('manager.jadwal.destroy', $item->id_jadwal_pemeliharaan) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
