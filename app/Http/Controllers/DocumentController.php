<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\LokasiPerbaikan;

class DocumentController extends Controller
{
    public function index()
    {
        $documentations = Document::all(); 
        $lokasiPerbaikanList = LokasiPerbaikan::all(); 
        return view('teknisi.upload-dokumentasi', compact('documentations','lokasiPerbaikanList')); // Send data to the view
    }
    public function create()
    {
        $documentations = Document::all(); 
        $lokasiPerbaikanList = LokasiPerbaikan::all(); 
        return view('teknisi.upload-dokumentasi', compact('documentations', 'lokasiPerbaikanList')); // Mengirimkan data ke view
    }

    public function store(Request $request)
    {
        $request->validate([
           'jadwal_perbaikan' => 'required|date',
            'waktu_perbaikan' => 'required|date_format:H:i',
            'gambar_dokumentasi' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kerusakan' => 'required|string',
            'jenis_perbaikan' => 'required|string',
            'lokasi_perbaikan' => 'required|string',
            'status_perbaikan' => 'required|string',
            'laporan' => 'nullable|string',
        ]);

        // Generate unique IDs
        
        $id_teknisi = auth()->id();

        // Handle file upload
        $filename = time() . '_' . $request->file('gambar_dokumentasi')->getClientOriginalName();
        $request->file('gambar_dokumentasi')->move(public_path('storage/dokumentasi'), $filename);

        // Save data to the database
        Document::create([
            
            'id_teknisi' => $id_teknisi,
            'jadwal_perbaikan' => $request->jadwal_perbaikan,
            'waktu_perbaikan' => $request->waktu_perbaikan,
            'jenis_perbaikan' => $request->jenis_perbaikan,
            'lokasi_perbaikan' => $request->lokasi_perbaikan,
            'status_perbaikan' => $request->status_perbaikan,
            'gambar_dokumentasi' => 'dokumentasi/' . $filename,
            'kerusakan' => $request->kerusakan,
            'laporan' => $request->laporan,
        ]);

       return redirect()->route('upload-dokumentasi')->with('success', 'Dokumentasi berhasil diunggah.');
    }
}