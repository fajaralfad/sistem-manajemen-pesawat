<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    public function create()
    {
        $documentations = Document::all(); // Mengambil semua dokumentasi
        return view('teknisi.upload-dokumentasi', compact('documentations')); // Mengirimkan data ke view
    }

    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'registration_number' => 'required',
            'status' => 'required',
            'report' => 'required',
            'aircraft_id' => 'required|numeric',
        ]);

        // Menyimpan file ke storage
        $filePath = $request->file('file')->store('uploads', 'public');

        // Menyimpan data dokumentasi ke database
        Document::create([
            'file_path' => $filePath,
            'aircraft_id' => $request->input('aircraft_id'),
            'status' => $request->input('status'),
            'report' => $request->input('report'),
            'registration_number' => $request->input('registration_number'),
        ]);

        // Mengarahkan kembali ke halaman dengan pesan sukses
        return redirect()->route('upload-dokumentasi')->with('success', 'Dokumentasi berhasil diunggah.');
    }
}