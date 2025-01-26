<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Model;

class JenisPtk extends Model
{
    protected $fillable = [
        'jenis_ptk',
        'keterangan',
    ];

    // Hash Many
    public function guru()
    {
        return $this->hasMany(Guru::class, 'jenis_ptk_id');
    }
    // End Hash Many
}
