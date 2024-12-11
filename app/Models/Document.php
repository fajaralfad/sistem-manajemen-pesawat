<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // Nama tabel yang ada di database
    protected $table = 'dokumentasi_pesawat'; // Ganti dengan nama tabel yang sesuai

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'registration_number', 'file_path', 'status', 'report', 'aircraft_id', 
        'technician_id', 'schedule_id', 'repair_schedule', 'image_path'
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
