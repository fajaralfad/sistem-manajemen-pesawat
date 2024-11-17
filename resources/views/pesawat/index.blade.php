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
                <td>{{ $pesawat->no_registrasi }}</td>
                <td>{{ $pesawat->nama_maskapai }}</td>
                <td>
                    <img src="{{ asset('storage/' . $pesawat->gambar_maskapai) }}" alt="Gambar Maskapai" width="80">
                </td>
                <td>{{ $pesawat->tipe_pesawat }}</td>
                <td>{{ $pesawat->jenis_pesawat }}</td>
                <td>{{ $pesawat->kapasitas_penumpang }}</td>
                <td>
    <!-- View button -->
    <a href="{{ route('pesawat.store', $pesawat->id_pesawat) }}" class="btn btn-info btn-sm">View</a>

    <!-- Edit button -->
    <a href="{{ route('admin.pesawat.edit', $pesawat->id_pesawat) }}" class="btn btn-warning btn-sm">Edit</a>

    <!-- Delete button with modal trigger -->
    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePesawatModal{{ $pesawat->id_pesawat }}">Delete</button>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deletePesawatModal{{ $pesawat->id_pesawat }}" tabindex="-1" aria-labelledby="deletePesawatModalLabel{{ $pesawat->id_pesawat }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePesawatModalLabel{{ $pesawat->id_pesawat }}">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus pesawat dengan nomor registrasi <b>{{ $pesawat->no_registrasi }}</b> dan maskapai <b>{{ $pesawat->nama_maskapai }}</b>?
                    Data yang dihapus tidak dapat dikembalikan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('admin.pesawat.destroy', $pesawat->id_pesawat) }}" method="POST" style="display:inline;">
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
                        <input type="text" name="tipe_pesawat" class="form-control">
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

<script>
    // Function to open the edit modal and populate it with pesawat data
    function openEditModal(pesawat) {
        const form = document.getElementById('editPesawatForm');
        form.action = `/pesawat/${pesawat.id_pesawat}`;
        form.querySelector('#edit_no_registrasi').value = pesawat.no_registrasi;
        form.querySelector('#edit_nama_maskapai').value = pesawat.nama_maskapai;
        form.querySelector('#edit_tipe_pesawat').value = pesawat.tipe_pesawat;
        form.querySelector('#edit_jenis_pesawat').value = pesawat.jenis_pesawat;
        form.querySelector('#edit_kapasitas_penumpang').value = pesawat.kapasitas_penumpang;


        const modal = new bootstrap.Modal(document.getElementById('editPesawatModal'));
        modal.show();
    }
</script>
@endsection