<?php

namespace App\Models\TataUsaha\Pembayaran;

use App\Models\TataUsaha\Transaksi;
use Illuminate\Database\Eloquent\Model;

class JenisPembayaran extends Model
{
    protected $fillable = [
        'nama_pembayaran',
        'total',
    ];

    // Has many
    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'jenis_pembayaran_id');
    }
    // End Has many
}
