<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusans = [
            ['name' => 'Rekayasa Perangkap Lunak'],
            ['name' => 'Teknik Basic Sepeda Motor'],
            ['name' => 'Manajemen Perkantoran'],
            ['name' => 'Perbankan Syariah'],
        ];

        foreach($jurusans as $jurusan) {
            Jurusan::create([
                'nama_jurusan' => $jurusan['name']
            ]);
        }
    }
}
