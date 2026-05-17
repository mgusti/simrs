<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    // Since we only need to read, we can disable timestamps if they don't exist
    // or just leave them if they do. Usually external tables might have different names.
    public $timestamps = false;
}
