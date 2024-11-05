<?php

namespace App\Http\Controllers;

use App\Models\Pesawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PesawatController extends Controller
{
    public function index()
    {
        $pesawatList = Pesawat::all(); // Mengambil semua data pesawat dari database
        return view('pesawat.index', compact('pesawatList'));
    }

    // Menampilkan form untuk menambah pesawat
    public function create()
    {
        return view('pesawat.create');
    }

    // Menyimpan data pesawat baru
    public function store(Request $request)
    {
        $request->validate([
            'no_registrasi' => 'required|string|max:255|unique:pesawat',
            'nama_maskapai' => 'required|string|max:255',
            'gambar_maskapai' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tipe_pesawat' => 'required|string|max:255',
            'jenis_pesawat' => 'required|string|max:255',
            'kapasitas_penumpang' => 'required|integer|min:1',
        ]);

        // Simpan gambar ke storage dan dapatkan path-nya
        $gambarPath = $request->file('gambar_maskapai')->store('public/gambar_maskapai');
        $gambarPath = Storage::url($gambarPath);

        // Simpan data pesawat ke database
        Pesawat::create([
            'no_registrasi' => $request->no_registrasi,
            'nama_maskapai' => $request->nama_maskapai,
            'gambar_maskapai' => $gambarPath,
            'tipe_pesawat' => $request->tipe_pesawat,
            'jenis_pesawat' => $request->jenis_pesawat,
            'kapasitas_penumpang' => $request->kapasitas_penumpang,
        ]);

        return redirect()->route('pesawat.index')->with('success', 'Pesawat berhasil ditambahkan');
    }
}
