<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = ['nm_dokter'];

    public function jadwal()
    {
        return $this->hasMany(JadwalDokter::class);
    }
}
