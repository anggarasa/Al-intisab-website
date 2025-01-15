<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class JenisKelamin extends Model
{
    protected $fillable = [
        'kelamin'
    ];

    // Hash many
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
    // Hash many
}
