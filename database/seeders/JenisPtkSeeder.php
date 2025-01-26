<?php

namespace Database\Seeders;

use App\Models\Guru\JenisPtk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPtkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ptks = [
            ['name' => 'GTY (Guru Tetap Yayasan)'],
            ['name' => 'GTTY (Guru Tidak Tetap Yayasan)'],
        ];

        foreach($ptks as $ptk) {
            JenisPtk::create([
                'jenis_ptk' => $ptk['name']
            ]);
        }
    }
}
