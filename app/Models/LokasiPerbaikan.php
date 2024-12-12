<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiPerbaikan extends Model
{
    use HasFactory;

    protected $table = 'lokasi_perbaikan';

    protected $fillable =[
        'id',
        'lokasi',
    ];
}
