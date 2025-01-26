<?php

namespace App\Models\Guru;

use App\Models\User;
use App\Models\Agama;
use App\Models\JenisKelamin;
use App\Models\Guru\JenisPtk;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_kelamin_id',
        'jenis_ptk_id',
        'agama_id',
        'name',
        'nip',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'foto',
        'status_kepegawaian',
    ];

    // Belongs To
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin_id');
    }

    public function ptk()
    {
        return $this->belongsTo(JenisPtk::class, 'jenis_ptk_id');
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id');
    }
    // End Belongs To
}
