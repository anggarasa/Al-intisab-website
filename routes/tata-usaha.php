<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\TataUsaha\Dashboard;
use App\Livewire\Pages\Tatausaha\Guru\ManajemenGuru;
use App\Livewire\Pages\TataUsaha\Kelas\ManajemenKelas;
use App\Livewire\Pages\TataUsaha\Pembayaran\InputPembayaran\InputPembayaran;
use App\Livewire\Pages\TataUsaha\Pembayaran\JenisPembayaran\ManajemenJenisPembayaran;
use App\Livewire\Pages\TataUsaha\Siswa\ManajemenSiswa;
Route::prefix('tata-usaha')->name('tata-usaha.')->middleware(['auth', 'role:tu'])->group(function() {
  Route::get('/dashboard', Dashboard::class)->name('dashboard');

  Route::prefix('manajemen-kelas')->name('manajemen-kelas.')->group(function() {
    Route::get('/kelas', ManajemenKelas::class)->name('manajemen');
  });

  Route::prefix('manajemen-siswa')->name('manajemen-siswa.')->group(function() {
    Route::get('/Siswa', ManajemenSiswa::class)->name('manajemen');
    });

    Route::prefix('manajemen-Guru')->name('manajemen-Guru.')->group(function() {
        Route::get('/Guru', ManajemenGuru::class)->name('manajemen');
    });

    Route::prefix('manajemen-pembayaran')->name('manajemen-pembayaran.')->group(function () {
      Route::get('/jenis-pembayaran', ManajemenJenisPembayaran::class)->name('jenis-pembayaran');
    });

    Route::get('/input-pembayaran', InputPembayaran::class)->name('input-pembayaran');
});
