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
        return $this->hasMany(Tagihan::class);
    }
    // End many to many
}
