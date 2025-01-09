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
            'name' => 'Siswa 1',
        ]);

        $user->siswa()->save($siswa);
    }
}
