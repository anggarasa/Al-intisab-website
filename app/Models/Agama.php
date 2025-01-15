<?php

namespace App\Models;

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
    // Hash many
}
