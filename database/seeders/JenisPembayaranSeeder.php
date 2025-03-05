<?php

namespace Database\Seeders;

use App\Models\TataUsaha\Pembayaran\JenisPembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pembayarans = [
            ['jenis' => 'SPP X', 'total' => 2000000],
            ['jenis' => 'SPP XI', 'total' => 3000000],
            ['jenis' => 'SPP XII', 'total' => 4000000],
            ['jenis' => 'Baju Seragam', 'total' => 850000],
            ['jenis' => 'Bangunan', 'total' => 1000000],
            ['jenis' => 'LKS', 'total' => 100000],
        ];

        foreach ($pembayarans as $pembayaran) {
            JenisPembayaran::create([
                'nama_pembayaran' => $pembayaran['jenis'],
                'total' => $pembayaran['total']
            ]);
        }
    }
}
