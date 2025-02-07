<?php

namespace Database\Seeders;

use App\Models\Kurikulum\Kurikulum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KurikulumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kurikulum = [
            ['nama_kurikulum' => 'Kurikulum 2013', 'deskripsi' => 'Kurikulum 2013 adalah kurikulum yang diterapkan di Indonesia sejak tahun 2013'],
            ['nama_kurikulum' => 'Kurikulum Merdeka', 'deskripsi' => 'Kurikulum Merdeka adalah kurikulum yang diterapkan di Indonesia sejak tahun 2022'],
            ['nama_kurikulum' => 'Kurikulum KTSP', 'deskripsi' => 'Kurikulum KTSP adalah kurikulum yang diterapkan di Indonesia sejak tahun 2006'],
            ['nama_kurikulum' => 'Kurikulum 1994', 'deskripsi' => 'Kurikulum 1994 adalah kurikulum yang diterapkan di Indonesia sejak tahun 1994'],
            ['nama_kurikulum' => 'Kurikulum 1984', 'deskripsi' => 'Kurikulum 1984 adalah kurikulum yang diterapkan di Indonesia sejak tahun 1984'],
            ['nama_kurikulum' => 'Kurikulum 1975', 'deskripsi' => 'Kurikulum 1975 adalah kurikulum yang diterapkan di Indonesia sejak tahun 1975'],
            ['nama_kurikulum' => 'Kurikulum 1968', 'deskripsi' => 'Kurikulum 1968 adalah kurikulum yang diterapkan di Indonesia sejak tahun 1968'],
            ['nama_kurikulum' => 'Kurikulum 1964', 'deskripsi' => 'Kurikulum 1964 adalah kurikulum yang diterapkan di Indonesia sejak tahun 1964'],
            ['nama_kurikulum' => 'Kurikulum 1952', 'deskripsi' => 'Kurikulum 1952 adalah kurikulum yang diterapkan di Indonesia sejak tahun 1952'],
            ['nama_kurikulum' => 'Kurikulum 1947', 'deskripsi' => 'Kurikulum 1947 adalah kurikulum yang diterapkan di Indonesia sejak tahun 1947'],
        ];

        foreach ($kurikulum as $data) {
            Kurikulum::create($data);
        }
    }
}
