<?php

namespace Database\Seeders;

use App\Models\Guru\Guru;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'email' => 'guru' . $i . '@gmail.com',
                'password' => bcrypt('guru' . $i)
            ]);

            $roles = ['guru', 'kurikulum', 'tu', 'keuangan'];
            $role = $roles[$i % count($roles)];
            $user->assignRole($role);

            $guru = new Guru([
                'jenis_kelamin_id' => rand(1, 2),
                'agama_id' => rand(1, 6),
                'jenis_ptk_id' => rand(1, 2),
                'name' => 'Guru ' . $i,
                'nip' => rand(100000000, 999999999),
                'nik' => rand(1000000000000, 9999999999999),
                'tempat_lahir' => 'subang',
                'tanggal_lahir' => date('Y-m-d', strtotime('-'.rand(10, 20).' years')),
                'alamat' => 'Jl. Raya Jl. Raya,Patok Besi,Subang No.20, Ciberes, Kec. Patokbeusi, Kabupaten Subang, Jawa Barat 41263',
                'no_hp' => rand(100000000000, 999999999999),
                'foto' => null,
            ]);

            $user->guru()->save($guru);
        }
    }
}
