<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesawat extends Model
{
    use HasFactory;

    protected $table = 'pesawat';

    protected $primaryKey = 'id_pesawat';

    protected $fillable = [
        'no_registrasi',
        'nama_maskapai',
        'gambar_maskapai',
        'tipe_pesawat',
        'jenis_pesawat',
        'kapasitas_penumpang',
    ];

}
