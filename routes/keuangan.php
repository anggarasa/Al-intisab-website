<?php 

use Illuminate\Support\Facades\Route;

Route::get('/keuangan', function() {
  echo 'Halaman keuangan';
})->middleware(['auth', 'role:keuangan']);