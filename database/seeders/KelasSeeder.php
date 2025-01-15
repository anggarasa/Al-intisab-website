<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelases = [
            ['nama' => 'XRPL', 'jurusan' => 1],
            ['nama' => 'XIRPL', 'jurusan' => 1],
            ['nama' => 'XIIRPL', 'jurusan' => 1],
            ['nama' => 'XTBSM', 'jurusan' => 2],
            ['nama' => 'XITBSM', 'jurusan' => 2],
            ['nama' => 'XIITBSM', 'jurusan' => 2],
            ['nama' => 'XMP', 'jurusan' => 3],
            ['nama' => 'XIMP', 'jurusan' => 3],
            ['nama' => 'XIIMP', 'jurusan' => 3],
            ['nama' => 'XPSY', 'jurusan' => 4],
            ['nama' => 'XIPSY', 'jurusan' => 4],
            ['nama' => 'XIIPSY', 'jurusan' => 4],
        ];

        foreach ($kelases as $kelas) {
            Kelas::create([
                'nama_kelas' => $kelas['nama'],
                'jurusan_id' => $kelas['jurusan'],
            ]);
        }
    }
}
