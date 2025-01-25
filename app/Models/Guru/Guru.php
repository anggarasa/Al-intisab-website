<?php

namespace App\Models\Guru;

use App\Models\User;
use App\Models\Agama;
use App\Models\JenisKelamin;
use App\Models\Guru\JenisPtk;
use App\Models\Guru\StatusKepegawaian;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_kelamin_id',
        'status_kepegawaian_id',
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

    public function kepegawaian()
    {
        return $this->belongsTo(StatusKepegawaian::class);
    }

    public function ptk()
    {
        return $this->belongsTo(JenisPtk::class);
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }
    // End Belongs To
}
