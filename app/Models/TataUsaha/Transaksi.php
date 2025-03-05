<?php

namespace App\Models\TataUsaha;

use App\Models\Siswa;
use App\Models\TataUsaha\Pembayaran\JenisPembayaran;
use App\Models\TataUsaha\Pembayaran\Tagihan;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'siswa_id',
        'tagihan_id',
        'jumlah_pembayaran',
        'sisa_tagihan',
        'tgl_pembayaran',
        'keterangan',
    ];

    // belongs to
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }
    // End belongs to
}
