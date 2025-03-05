<?php

namespace App\Models\TataUsaha\Pembayaran;

use App\Models\Siswa;
use App\Models\TataUsaha\Transaksi;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $fillable = [
        'siswa_id',
        'jenis_pembayaran_id',
        'total_tagihan',
        'sisa_tagihan',
    ];

    // belongs to
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class, 'jenis_pembayaran_id');
    }
    // End belongs to

    // has many
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
    // End has many
}
