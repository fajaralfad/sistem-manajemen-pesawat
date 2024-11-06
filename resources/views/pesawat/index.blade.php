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
    <table id="usersTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID Pesawat</th>
                <th>No Registrasi</th>
                <th>Nama Maskapai</th>
                <th>Gambar Maskapai</th>
                <th>Tipe Pesawat</th>
                <th>Jenis Pesawat</th>
                <th>Kapasitas Penumpang</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesawatList as $pesawat)
            <tr>
                <td>{{ $pesawat->id_pesawat }}</td>
                <td>{{ $pesawat->no_registrasi }}</td>
                <td>{{ $pesawat->nama_maskapai }}</td>
                <td>
                    <img src="{{ asset('storage/' . $pesawat->gambar_maskapai) }}" alt="Gambar Maskapai" width="80">
                </td>
                <td>{{ $pesawat->tipe_pesawat }}</td>
                <td>{{ $pesawat->jenis_pesawat }}</td>
                <td>{{ $pesawat->kapasitas_penumpang }}</td>
                <td>
                    <!-- View button
                    <a href="" class="btn btn-info btn-sm">View</a> -->

                    <!-- Edit button -->
                    <button class="btn btn-warning btn-sm" onclick="openEditModal({{ $pesawat }})">Edit</button>

                    <!-- Delete form -->
                    <form action="{{ route('admin.pesawat.destroy', $pesawat->id_pesawat) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
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

<!-- Modal Edit Pesawat -->
<div class="modal fade" id="editPesawatModal" tabindex="-1" aria-labelledby="editPesawatLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editPesawatForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editPesawatLabel">Edit Pesawat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- No Registrasi -->
                    <div class="mb-3">
                        <label for="edit_no_registrasi" class="form-label">No Registrasi</label>
                        <input type="text" name="no_registrasi" id="edit_no_registrasi" class="form-control" required>
                    </div>

                    <!-- Nama Maskapai -->
                    <div class="mb-3">
                        <label for="edit_nama_maskapai" class="form-label">Nama Maskapai</label>
                        <input type="text" name="nama_maskapai" id="edit_nama_maskapai" class="form-control" required>
                    </div>

                    <!-- Gambar Maskapai -->
                    <div class="mb-3">
                        <label for="edit_gambar_maskapai" class="form-label">Gambar Maskapai</label>
                        <input type="file" name="gambar_maskapai" id="edit_gambar_maskapai" class="form-control" accept="image/*">
                    </div>

                    <!-- Tipe Pesawat -->
                    <div class="mb-3">
                        <label for="edit_tipe_pesawat" class="form-label">Tipe Pesawat</label>
                        <select name="tipe_pesawat" id="edit_tipe_pesawat" class="form-select" required>
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
                        <label for="edit_jenis_pesawat" class="form-label">Jenis Pesawat</label>
                        <select name="jenis_pesawat" id="edit_jenis_pesawat" class="form-select" required>
                            <option value="" disabled selected>Pilih Jenis Pesawat</option>
                            <option value="Penumpang">Penumpang</option>
                            <option value="Kargo">Kargo</option>
                            <option value="Pribadi">Pribadi</option>
                        </select>
                    </div>

                    <!-- Kapasitas Penumpang -->
                    <div class="mb-3">
                        <label for="edit_kapasitas_penumpang" class="form-label">Kapasitas Penumpang</label>
                        <input type="number" name="kapasitas_penumpang" id="edit_kapasitas_penumpang" class="form-control" min="1" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to open the edit modal and populate it with pesawat data
        window.openEditModal = function(pesawat) {
            // Parse JSON if needed or use directly if passed as object
            const form = document.getElementById('editPesawatForm');
            form.action = `/admin/pesawat/${pesawat.id_pesawat}`;
            form.querySelector('#edit_no_registrasi').value = pesawat.no_registrasi;
            form.querySelector('#edit_nama_maskapai').value = pesawat.nama_maskapai;
            form.querySelector('#edit_tipe_pesawat').value = pesawat.tipe_pesawat;
            form.querySelector('#edit_jenis_pesawat').value = pesawat.jenis_pesawat;
            form.querySelector('#edit_kapasitas_penumpang').value = pesawat.kapasitas_penumpang;

            const modal = new bootstrap.Modal(document.getElementById('editPesawatModal'));
            modal.show();
        };
    });
</script>

@endsection