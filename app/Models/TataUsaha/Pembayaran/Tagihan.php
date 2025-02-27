<?php

namespace App\Models\TataUsaha\Pembayaran;

use App\Models\Siswa;
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
    // End belongs to

    // Many to many
    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class, 'jenis_pembayaran_id');
    }
    // End Many to many
}
