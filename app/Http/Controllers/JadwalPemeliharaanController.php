<?php

namespace App\Http\Controllers;

use App\Models\JadwalPemeliharaanPesawat;
use App\Models\Pesawat;
use Illuminate\Http\Request;

class JadwalPemeliharaanController extends Controller
{
    // Menampilkan daftar semua jadwal pemeliharaan
    // Menampilkan daftar semua jadwal pemeliharaan
    public function index()
    {
        // Ambil semua data jadwal pemeliharaan pesawat dari database
        $jadwals = JadwalPemeliharaanPesawat::with('pesawat')->get(); // Mengambil data jadwal pemeliharaan
    
        // Ambil semua data pesawat untuk dropdown di form
        $pesawat = Pesawat::all(); // Menambahkan pesawat ke view
    
        // Kirim data ke view
        return view('manager.jadwal.index', compact('jadwals', 'pesawat'));
    }    

    // Menampilkan form untuk membuat jadwal pemeliharaan baru
    public function create()
{
    $pesawat = Pesawat::all(); // Mengambil semua pesawat untuk dropdown

    // Mengirim data pesawat ke view
    return view('manager.jadwal.create', compact('pesawat'));
}

    // Menyimpan data jadwal pemeliharaan baru ke database
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'id_pesawat' => 'required|exists:pesawat,id_pesawat', // Pastikan id_pesawat valid
            'jadwal_pemeliharaan' => 'required|date', // Format tanggal yang benar
            'deskripsi' => 'required|string',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled', // Status yang valid
        ]);

        // Menyimpan data jadwal pemeliharaan ke database
        JadwalPemeliharaanPesawat::create($request->all());

        // Redirect setelah data berhasil disimpan
        return redirect()->route('manager.jadwal.index')->with('success', 'Jadwal pemeliharaan berhasil ditambahkan.');
    }

    // Menampilkan detail jadwal pemeliharaan tertentu
    public function show($id)
    {
        // Mengambil data jadwal pemeliharaan dengan relasi pesawat
        $jadwal = JadwalPemeliharaanPesawat::with('pesawat')->findOrFail($id);
        
        // Mengirim data ke view jadwal.show
        return view('manager.jadwal.show', compact('jadwal'));
    }

    // Menampilkan form untuk mengedit jadwal pemeliharaan
    public function edit($id)
    {
        // Mengambil data jadwal pemeliharaan berdasarkan ID
        $jadwal = JadwalPemeliharaanPesawat::findOrFail($id);
        
        // Mengambil semua data pesawat untuk pilihan di form edit
        $pesawat = Pesawat::all();
        
        // Mengirim data jadwal dan pesawat ke view jadwal.edit
        return view('manager.jadwal.edit', compact('jadwal', 'pesawat'));
    }

    // Mengupdate data jadwal pemeliharaan di database
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'id_pesawat' => 'required|exists:pesawat,id_pesawat', // Pastikan id_pesawat valid
            'jadwal_pemeliharaan' => 'required|date', // Format tanggal yang benar
            'deskripsi' => 'required|string',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled', // Status yang valid
        ]);

        // Mengambil data jadwal yang akan diupdate
        $jadwal = JadwalPemeliharaanPesawat::findOrFail($id);
        
        // Mengupdate data jadwal dengan data yang diterima dari form
        $jadwal->update($request->all());

        // Redirect setelah data berhasil diupdate
        return redirect()->route('manager.jadwal.index')->with('success', 'Jadwal pemeliharaan berhasil diperbarui.');
    }

    // Menghapus jadwal pemeliharaan dari database
    public function destroy($id)
    {
        // Mengambil data jadwal berdasarkan ID
        $jadwal = JadwalPemeliharaanPesawat::findOrFail($id);
        
        // Menghapus data jadwal
        $jadwal->delete();

        // Redirect setelah data berhasil dihapus
        return redirect()->route('manager.jadwal.index')->with('success', 'Jadwal pemeliharaan berhasil dihapus.');
    }
}

