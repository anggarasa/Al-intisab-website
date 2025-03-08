<?php

namespace Database\Seeders;

use App\Models\IdentitasSekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentitasSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IdentitasSekolah::create([
            'nama_sekolah' => 'SMK AL-INTISAB PATOKBEUSI',
            'npsn' => '12345678',
            'email' => 'smk_alintisab@yahoo.com',
            'no_telpone' => '(0260) 7615251',
            'alamat_sekolah' => 'Jl. Raya Ciberes No. 20',
            'kelurahan' => 'Ciberes',
            'kecamatan' => 'Patokbeusi',
            'kabupaten_kota' => 'Subang',
            'provinsi' => 'Jawa Barat',
            'kode_pos' => '41263',
            'akreditasi' => 'A',
            'kepala_sekolah' => 'H. Wasep Burhanudin, S.T',
            'logo' => '/logo/logo-yai.svg',
        ]);
    }
}
