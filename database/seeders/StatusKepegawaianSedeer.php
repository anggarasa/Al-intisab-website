<?php

namespace Database\Seeders;

use App\Models\Guru\StatusKepegawaian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusKepegawaianSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'AKTIF'],
            ['name' => 'TIDAK AKTIF'],
        ];

        foreach($statuses as $status) {
            StatusKepegawaian::create([
                'status' => $status['name']
            ]);
        }
    }
}
