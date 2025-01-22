<?php

namespace Database\Seeders;

use App\Models\Agama;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agama::create([
            'agama' => 'Islam'
        ]);
        Agama::create([
            'agama' => 'Kristen'
        ]);
        Agama::create([
            'agama' => 'Katolik'
        ]);
        Agama::create([
            'agama' => 'Hindu'
        ]);
        Agama::create([
            'agama' => 'Buddha'
        ]);
        Agama::create([
            'agama' => 'Konghucu'
        ]);
    }
}
