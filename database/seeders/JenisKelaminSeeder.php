<?php

namespace Database\Seeders;

use App\Models\JenisKelamin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKelaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelamins = [
            ['name' => 'laki-laki'],
            ['name' => 'perempuan']
        ];

        foreach ($kelamins as $kelamin) {
            JenisKelamin::create([
                'kelamin' => $kelamin['name']
            ]);
        }
    }
}
