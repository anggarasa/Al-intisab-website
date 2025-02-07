<?php

use App\Livewire\Pages\Kurikulum\Dashboard;
use Illuminate\Support\Facades\Route;

Route::prefix('kurikulum')->name('kurikulum.')->middleware(['auth', 'verified', 'role:kurikulum'])->group(function () {
  Route::get('/dashboard', Dashboard::class)->name('dashboard');
});