<?php

namespace App\Models\Guru;

use Illuminate\Database\Eloquent\Model;

class StatusKepegawaian extends Model
{
    protected $fillable = [
        'status',
        'keterangan',
    ];

    // Hash Many
    public function guru()
    {
        return $this->hasMany(Guru::class, 'status_kepegawaian_id');
    }
    // End Hash Many
}
