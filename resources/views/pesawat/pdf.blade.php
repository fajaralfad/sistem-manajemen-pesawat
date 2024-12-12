<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pesawat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Daftar Pesawat</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
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
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pesawat->no_registrasi }}</td>
                <td>{{ $pesawat->nama_maskapai }}</td>
                <td>
                    <img src="{{ public_path('storage/' . $pesawat->gambar_maskapai) }}" alt="Gambar Maskapai" width="80">
                </td>
                <td>{{ $pesawat->tipe_pesawat }}</td>
                <td>{{ $pesawat->jenis_pesawat }}</td>
                <td>{{ $pesawat->kapasitas_penumpang }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>