<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Guru\Guru;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $fillable = [
        'agama'
    ];

    // Hash many
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    public function guru()
    {
        return $this->hasMany(Guru::class, 'agama_id');
    }
    // Hash many
}
