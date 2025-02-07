<?php

use App\Livewire\Pages\Kurikulum\Dashboard;
use App\Livewire\Pages\Kurikulum\Kurikulum\ManajemenKurikulum;
use Illuminate\Support\Facades\Route;

Route::prefix('kurikulum')->name('kurikulum.')->middleware(['auth', 'verified', 'role:kurikulum'])->group(function () {
  Route::get('/dashboard', Dashboard::class)->name('dashboard');

  // Manajemen
  Route::prefix('manajemen')->name('manajemen.')->group(function () {
    Route::get('/kurikulum', ManajemenKurikulum::class)->name('kurikulum');
  });
});