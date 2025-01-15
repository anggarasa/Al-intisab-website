<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\TataUsaha\Dashboard;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::get('/dashboard-tu', Dashboard::class)->name('dashboard');
    
require __DIR__.'/auth.php';
require __DIR__.'/kurikulum.php';
require __DIR__.'/guru.php';
require __DIR__.'/siswa.php';
require __DIR__.'/tata-usaha.php';
require __DIR__.'/keuangan.php';
