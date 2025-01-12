<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdentitasSekolah extends Model
{
    protected $fillable = [
        'npsn',
        'email',
        'provinsi',
        'kode_pos',
        'kelurahan',
        'kecamatan',
        'akreditasi',
        'no_telpone',
        'nama_sekolah',
        'kepala_sekolah',
        'alamat_sekolah',
        'kabupaten_kota',
    ];
}
