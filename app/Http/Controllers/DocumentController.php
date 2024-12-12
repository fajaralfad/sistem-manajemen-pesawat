<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\LokasiPerbaikan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documentations = Document::all(); 
        $lokasiPerbaikanList = LokasiPerbaikan::all(); 
        return view('teknisi.upload-dokumentasi', compact('documentations', 'lokasiPerbaikanList')); // Send data to the view
    }

    public function create()
    {
        $documentations = Document::all(); 
        $lokasiPerbaikanList = LokasiPerbaikan::all(); // Fetch all lokasi perbaikan
        return view('teknisi.upload-dokumentasi', compact('documentations', 'lokasiPerbaikanList')); // Send data to the view
    }

    public function store(Request $request)
    {
        Log::info('Store method called');
        $request->validate([
            'jadwal_perbaikan' => 'required|date',
            'waktu_perbaikan' => 'required|date_format:H:i',
            'gambar_dokumentasi' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kerusakan' => 'required|string',
            'jenis_perbaikan' => 'required|string',
            'lokasi_perbaikan_id' => 'required|exists:lokasi_perbaikan,id',
            'status_perbaikan' => 'required|string',
            'laporan' => 'nullable|string',
        ]);

        try {
            $id_teknisi = auth()->id();
            Log::info('Authenticated teknisi ID: ' . $id_teknisi);

            // Handle file upload
            $filename = time() . '_' . $request->file('gambar_dokumentasi')->getClientOriginalName();
            $request->file('gambar_dokumentasi')->move(public_path('storage/dokumentasi'), $filename);
            Log::info('File uploaded: ' . $filename);

            // Save data to the database
            Document::create([
                'id_teknisi' => $id_teknisi,
                'jadwal_perbaikan' => $request->jadwal_perbaikan,
                'waktu_perbaikan' => $request->waktu_perbaikan,
                'jenis_perbaikan' => $request->jenis_perbaikan,
                'lokasi_perbaikan_id' => $request->lokasi_perbaikan_id,
                'status_perbaikan' => $request->status_perbaikan,
                'gambar_dokumentasi' => 'dokumentasi/' . $filename,
                'kerusakan' => $request->kerusakan,
                'laporan' => $request->laporan,
            ]);
            Log::info('Data saved to database');

            return redirect()->route('upload-dokumentasi')->with('success', 'Dokumentasi berhasil diunggah.');
        } catch (\Exception $e) {
            Log::error('Error saving documentation: ' . $e->getMessage());
            return redirect()->route('upload-dokumentasi')->with('error', 'Terjadi kesalahan saat mengunggah dokumentasi.');
        }
    }

    public function edit($id_dokumentasi)
    {
        $documentation = Document::findOrFail($id_dokumentasi);
        $lokasiPerbaikanList = LokasiPerbaikan::all();
        return view('teknisi.edit-dokumentasi', compact('documentation', 'lokasiPerbaikanList'));
    }

    public function update(Request $request, $id_dokumentasi)
    {
        Log::info('Update method called');
        $request->validate([
            'jadwal_perbaikan' => 'required|date',
            'waktu_perbaikan' => 'required|date_format:H:i',
            'gambar_dokumentasi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kerusakan' => 'required|string',
            'jenis_perbaikan' => 'required|string',
            'lokasi_perbaikan_id' => 'required|exists:lokasi_perbaikan,id',
            'status_perbaikan' => 'required|string',
            'laporan' => 'nullable|string',
        ]);

        try {
            $documentation = Document::findOrFail($id_dokumentasi);
            Log::info('Found documentation with ID: ' . $id_dokumentasi);

            // Handle file upload if a new file is uploaded
            if ($request->hasFile('gambar_dokumentasi')) {
                // Delete the old file
                if ($documentation->gambar_dokumentasi) {
                    Storage::delete('public/' . $documentation->gambar_dokumentasi);
                }

                // Save the new file
                $filename = time() . '_' . $request->file('gambar_dokumentasi')->getClientOriginalName();
                $request->file('gambar_dokumentasi')->move(public_path('storage/dokumentasi'), $filename);
                $documentation->gambar_dokumentasi = 'dokumentasi/' . $filename;
                Log::info('File uploaded: ' . $filename);
            }

            // Update the documentation data
            $documentation->update([
                'jadwal_perbaikan' => $request->jadwal_perbaikan,
                'waktu_perbaikan' => $request->waktu_perbaikan,
                'jenis_perbaikan' => $request->jenis_perbaikan,
                'lokasi_perbaikan_id' => $request->lokasi_perbaikan_id,
                'status_perbaikan' => $request->status_perbaikan,
                'kerusakan' => $request->kerusakan,
                'laporan' => $request->laporan,
            ]);
            Log::info('Data updated in database');

            return redirect()->route('upload-dokumentasi')->with('success', 'Dokumentasi berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating documentation: ' . $e->getMessage());
            return redirect()->route('upload-dokumentasi')->with('error', 'Terjadi kesalahan saat memperbarui dokumentasi.');
        }
    }

    public function destroy($id_dokumentasi)
    {
        Log::info('Destroy method called');
        try {
            $documentation = Document::findOrFail($id_dokumentasi);
            Log::info('Found documentation with ID: ' . $id_dokumentasi);

            // Delete the file from storage
            if ($documentation->gambar_dokumentasi) {
                Storage::delete('public/' . $documentation->gambar_dokumentasi);
                Log::info('File deleted: ' . $documentation->gambar_dokumentasi);
            }

            // Delete the documentation from the database
            $documentation->delete();
            Log::info('Documentation deleted from database');

            return redirect()->route('upload-dokumentasi')->with('success', 'Dokumentasi berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting documentation: ' . $e->getMessage());
            return redirect()->route('upload-dokumentasi')->with('error', 'Terjadi kesalahan saat menghapus dokumentasi.');
        }
    }
}