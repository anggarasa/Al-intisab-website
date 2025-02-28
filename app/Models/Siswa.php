<?php

namespace App\Models;

use App\Models\TataUsaha\Pembayaran\Tagihan;
use App\Models\TataUsaha\Transaksi;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'user_id',
        'kelas_id',
        'jurusan_id',
        'jenis_kelamin_id',
        'agama_id',
        'name',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nik',
        'no_hp',
        'foto',
        'nama_ayah',
        'nama_ibu',
        'nama_wali',
    ];

    // Belongs to
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin_id');
    }
    // Belongs to

    // has many
    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }
    
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
    // End has many
}
