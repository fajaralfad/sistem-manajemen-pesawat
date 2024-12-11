<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Dokumentasi Pesawat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Upload Dokumentasi Pesawat</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <style>
    body {
        background: url('{{ asset('images/bg-dashboard.png') }}') no-repeat center center fixed;
        background-size: cover;
    }
    .card {
        background-color: rgba(255, 255, 255, 0.8);
    }
</style>

        <!-- Tombol untuk membuka modal -->
        <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#uploadModal">Upload Dokumentasi</button>

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
                            <div class="form-group">
                                <label for="registration_number">Id Dokumentasi:</label>
                                <input type="text" class="form-control" id="id_dokumentasi" name="id_dokumentasi" required>
                            </div>
                            <div class="form-group">
                                <label for="registration_number">Id Teknisi:</label>
                                <input type="text" class="form-control" id="id_teknisi" name="id_teknisi" required>
                            </div>
                            <div class="form-group">
                                <label for="registration_number">Id Jadwal:</label>
                                <input type="text" class="form-control" id="id_jadwal" name="id_jadwal" required>
                            </div>
                            <div class="form-group">
                                <label for="registration_number">Jadwal perbaikan:</label>
                                <input type="text" class="form-control" id="registration_number" name="registration_number" required>
                            </div>

                            <div class="form-group">
                                <label for="file">gambar dokumentasi:</label>
                                <input type="file" class="form-control" id="file" name="file" required>
                            </div>

                            <div class="form-group">
                                <label for="status">laporan:</label>
                                <input type="text" class="form-control" id="status" name="status" required>
                            </div>

                            

                            <button type="submit" class="btn btn-primary mt-3">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Dokumentasi -->
        <h3 class="mt-5">Daftar Dokumentasi Pesawat</h3>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Id Dokumentasi</th>
                    <th>Id Teknisi</th>
                    <th>Id Jadwal</th>
                    <th>Jadwal perbaikan</th>
                    <th>gambar dokumentasi</th>
                    <th>laporan</th>
                
                </tr>
            </thead>
            <tbody>
                @foreach($documentations as $documentation)
                    <tr>
                        <td>{{ $documentation->registration_number }}</td>
                        <td><a href="{{ asset('storage/' . $documentation->file_path) }}" target="_blank">Lihat File</a></td>
                        <td>{{ $documentation->status }}</td>
                        <td>{{ $documentation->report }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
