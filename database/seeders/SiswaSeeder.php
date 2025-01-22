<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'email' => "siswa$i@gmail.com",
                'password' => bcrypt("siswa$i")
            ]);
            $user->assignRole('siswa');

            $siswa = new Siswa([
                'jenis_kelamin_id' => rand(1, 2),
                'kelas_id' => rand(1, 12),
                'jurusan_id' => rand(1, 4),
                'agama_id' => rand(1, 6),
                'name' => "Siswa $i",
                'nisn' => rand(100000000, 999999999),
                'tempat_lahir' => 'subang',
                'tanggal_lahir' => date('Y-m-d', strtotime('-'.rand(10, 20).' years')),
                'alamat' => 'Jl. Raya Jl. Raya,Patok Besi,Subang No.20, Ciberes, Kec. Patokbeusi, Kabupaten Subang, Jawa Barat 41263',
                'nik' => rand(1000000000000, 9999999999999),
                'no_hp' => rand(100000000000, 999999999999),
                'foto' => null,
                'nama_ayah' => 'nandang',
                'nama_ibu' => 'kurnia',
            ]);

            $user->siswa()->save($siswa);
        }
    }
}
