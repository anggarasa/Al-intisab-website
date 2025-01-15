<?php

use App\Livewire\Pages\TataUsaha\Dashboard;
use App\Livewire\Pages\TataUsaha\Kelas\ManajemenKelas;
use Illuminate\Support\Facades\Route;

Route::prefix('tata-usaha')->name('tata-usaha.')->middleware(['auth', 'role:tu'])->group(function() {
  Route::get('/dashboard', Dashboard::class)->name('dashboard');

  Route::prefix('manajemen-kelas')->name('manajemen-kelas.')->group(function() {
    Route::get('/kelas', ManajemenKelas::class)->name('manajemen');
  });
});
