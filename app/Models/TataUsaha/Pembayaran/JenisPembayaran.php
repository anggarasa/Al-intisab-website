<?php

namespace App\Models\TataUsaha\Pembayaran;

use Illuminate\Database\Eloquent\Model;

class JenisPembayaran extends Model
{
    protected $fillable = [
        'nama_pembayaran',
        'total',
    ];

    // many to many
    public function tagihans()
    {
        return $this->belongsToMany(Tagihan::class, 'tagihan_to_jenis_pembayaran');
    }
    // End many to many
}
