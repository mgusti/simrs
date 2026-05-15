<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokter_id',
        'ruangan_id',
        'jam_mulai',
        'jam_selesai',
        'hari_kerja',
        'aktivasi'
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
