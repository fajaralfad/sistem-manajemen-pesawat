<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPemeliharaanPesawat extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pemeliharaan_pesawat';
    protected $primaryKey = 'id_jadwal_pemeliharaan';

    protected $fillable = [
        'id_pesawat',
        'jadwal_pemeliharaan',
        'deskripsi',
        'status'
    ];

    // Relasi ke tabel pesawat
    public function pesawat()
    {
        return $this->belongsTo(Pesawat::class, 'id_pesawat', 'id_pesawat');
    }
}

