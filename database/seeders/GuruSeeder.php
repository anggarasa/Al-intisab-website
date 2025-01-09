<?php

namespace Database\Seeders;

use App\Models\Guru;
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
                'name' => 'Guru ' . $i,
            ]);

            $user->guru()->save($guru);
        }
    }
}
