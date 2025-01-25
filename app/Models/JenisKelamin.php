<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Guru\Guru;
use PhpParser\Node\Expr\FuncCall;
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
        return $this->hasMany(Siswa::class, 'jenis_kelamin_id');
    }

    public function guru()
    {
        return $this->hasMany(Guru::class, 'jenis_kelamin_id');
    }
    // Hash many
}
