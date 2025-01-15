<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Siswa extends Model
{
    protected $fillable = [
        'name',
        'user_id'
    ];

    // Belongs to
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelamin()
    {
        return $this->belongsTo(JenisKelamin::class);
    }
    // Belongs to
}
