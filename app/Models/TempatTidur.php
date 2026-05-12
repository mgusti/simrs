<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempatTidur extends Model
{
    protected $table = 'new_tt';
    public $timestamps = false;

    protected $fillable = [
        'kodekelas',
        'kelas',
        'ruang',
        'kode_ruang',
        'tersedia',
        'kapasitas',
        'tersediawanita',
        'tersediapria',
        'tersediapriawanita',
        'ts',
    ];
}
