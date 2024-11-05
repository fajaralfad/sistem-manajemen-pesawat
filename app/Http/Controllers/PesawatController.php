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

        // Generate a unique filename
        $filename = time() . '_' . $request->file('gambar_maskapai')->getClientOriginalName();

        // Move the uploaded file to the public storage directory
        $request->file('gambar_maskapai')->move(public_path('storage/gambar_maskapai'), $filename);

        // Simpan data pesawat ke database
        Pesawat::create([
            'no_registrasi' => $request->no_registrasi,
            'nama_maskapai' => $request->nama_maskapai,
            'gambar_maskapai' => 'gambar_maskapai/' . $filename,
            'tipe_pesawat' => $request->tipe_pesawat,
            'jenis_pesawat' => $request->jenis_pesawat,
            'kapasitas_penumpang' => $request->kapasitas_penumpang,
        ]);

        return redirect()->route('pesawat.index')->with('success', 'Pesawat berhasil ditambahkan');
    }

    // Menampilkan detail pesawat
    public function show($id)
    {
        $pesawat = Pesawat::findOrFail($id);
        return view('pesawat.show', compact('pesawat'));
    }

    // Menampilkan form edit pesawat
    public function edit($id)
    {
        $pesawat = Pesawat::findOrFail($id);
        return response()->json($pesawat);
    }

    // Mengupdate data pesawat
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_registrasi' => 'required|string|max:255|unique:pesawat,no_registrasi,' . $id,
            'nama_maskapai' => 'required|string|max:255',
            'gambar_maskapai' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tipe_pesawat' => 'required|string|max:255',
            'jenis_pesawat' => 'required|string|max:255',
            'kapasitas_penumpang' => 'required|integer|min:1',
        ]);

        $pesawat = Pesawat::findOrFail($id);

        // Update gambar jika ada file baru yang diupload
        if ($request->hasFile('gambar_maskapai')) {
            // Hapus gambar lama
            if ($pesawat->gambar_maskapai) {
                Storage::delete('public/' . $pesawat->gambar_maskapai);
            }

            // Simpan gambar baru
            $filename = time() . '_' . $request->file('gambar_maskapai')->getClientOriginalName();
            $request->file('gambar_maskapai')->move(public_path('storage/gambar_maskapai'), $filename);
            $pesawat->gambar_maskapai = 'gambar_maskapai/' . $filename;
        }

        // Update data pesawat
        $pesawat->update([
            'no_registrasi' => $request->no_registrasi,
            'nama_maskapai' => $request->nama_maskapai,
            'tipe_pesawat' => $request->tipe_pesawat,
            'jenis_pesawat' => $request->jenis_pesawat,
            'kapasitas_penumpang' => $request->kapasitas_penumpang,
        ]);

        return redirect()->route('pesawat.index')->with('success', 'Pesawat berhasil diupdate');
    }

    // Menghapus data pesawat
    public function destroy($id)
    {
        $pesawat = Pesawat::findOrFail($id);

        // Hapus gambar dari storage
        if ($pesawat->gambar_maskapai) {
            Storage::delete('public/' . $pesawat->gambar_maskapai);
        }

        // Hapus data pesawat dari database
        $pesawat->delete();

        return redirect()->route('pesawat.index')->with('success', 'Pesawat berhasil dihapus');
    }
}