<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicianHistory extends Model
{
    use HasFactory;

    protected $table = 'technician_histories';

    protected $fillable = [
        'technician_id',
        'plane_id',
        'status',
        'work_date',
        'description',
    ];

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    public function plane()
    {
        return $this->belongsTo(Plane::class);
    }
}