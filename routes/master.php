<?php

use App\Livewire\Pages\Master\Dashboard;
use App\Livewire\Pages\Master\Data\ManajemenData;
use App\Livewire\Pages\Master\Kelas\ManajemenKelas;
use App\Livewire\Pages\Master\Kurikulum\ManajemenKurikulum;
use App\Livewire\Pages\Master\User\Guru\ManajemenGuru;
use App\Livewire\Pages\Master\User\ManajemenUser;
use App\Livewire\Pages\Master\User\Siswa\ManajemenSiswa;
use Illuminate\Support\Facades\Route;
Route::prefix('master')->name('master.')->middleware(['auth', 'role:master'])->group(function() {
    // Dasboard master
    Route::get('/dashboard-master', Dashboard::class)->name('dashboard-master');

    // Manajemen
    Route::prefix('manajemen')->name('manajemen.')->group(function() {
        // Manajemdn data
        Route::get('/data', ManajemenData::class)->name('data');

        // manajemen kelas
        Route::get('/kelas', ManajemenKelas::class)->name('kelas');

        // Manajemen user
        Route::get('/user', ManajemenUser::class)->name('user');

        // manajemen siswa
        Route::get('/siswa', ManajemenSiswa::class)->name('siswa');

        // manajemen guru
        Route::get('/guru', ManajemenGuru::class)->name('guru');

        // manajemen kurikulum
        Route::get('/kurikulum', ManajemenKurikulum::class)->name('kurikulum');
    });
});
