<?php

use App\Livewire\Pages\TataUsaha\Dashboard;
use Illuminate\Support\Facades\Route;

Route::prefix('tata-usaha')->name('tata-usaha.')->middleware(['auth', 'role:tu'])->group(function() {
  Route::get('/dashboard', Dashboard::class)->name('dashboard');
});