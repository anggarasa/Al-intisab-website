<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'kurikulum']);
        Role::create(['name' => 'tu']);
        Role::create(['name' => 'keuangan']);
        Role::create(['name' => 'guru']);
        Role::create(['name' => 'siswa']);
        Role::create(['name' => 'master']);
    }
}
