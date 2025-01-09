<?php 

use Illuminate\Support\Facades\Route;

Route::get('/siswa', function() {
  echo 'Halaman siswa';
})->middleware(['auth', 'role:siswa']);