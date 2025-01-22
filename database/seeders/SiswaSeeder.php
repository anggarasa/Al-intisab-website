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
        $user = User::create([
            'email' => 'siswa1@gmail.com',
            'password' => bcrypt('siswa123')
        ]);
        $user->assignRole('siswa');

        $siswa = new Siswa([
            'jenis_kelamin_id' => 1,
            'kelas_id' => 1,
            'jurusan_id' => 1,
            'agama_id' => 1,
            'name' => 'Siswa 1',
            'nisn' => '123456432',
            'tempat_lahir' => 'subang',
            'tanggal_lahir' => '2012-01-23',
            'alamat' => 'Jl. Raya Jl. Raya,Patok Besi,Subang No.20, Ciberes, Kec. Patokbeusi, Kabupaten Subang, Jawa Barat 41263',
            'nik' => '627167826871',
            'no_hp' => '084632563246',
            'foto' => 'siswa/image.jpg',
            'nama_ayah' => 'nandang',
            'nama_ibu' => 'kurnia',
        ]);

        $user->siswa()->save($siswa);
    }
}
