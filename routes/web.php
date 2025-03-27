<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return auth()->check() ? redirect(route('dashboard')) : redirect(route('login'));
});

Route::get('pdf', function() {
    return view('pdf.riwayat-pembayaran-semua-siswa');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__.'/auth.php';
require __DIR__.'/kurikulum.php';
require __DIR__.'/guru.php';
require __DIR__.'/siswa.php';
require __DIR__.'/tata-usaha.php';
require __DIR__.'/keuangan.php';
require __DIR__.'/master.php';
