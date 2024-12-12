<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // Nama tabel yang ada di database
    protected $table = 'dokumentasi_pesawat'; // Ganti dengan nama tabel yang sesuai
    protected $primaryKey = 'id_dokumentasi';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_dokumentasi',
        'id_teknisi',
        'id_jadwal',
        'jadwal_perbaikan',
        'waktu_perbaikan',
        'jenis_perbaikan',
        'lokasi_perbaikan_id',
        'status_perbaikan',
        'waktu_perbaikan',
        'gambar_dokumentasi',
        'kerusakan',
        'laporan'
    ];

    // Jika ada relasi, misalnya ke model Technician atau Schedule
    public function technician()
    {
        return $this->belongsTo(Technician::class, 'technician_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
