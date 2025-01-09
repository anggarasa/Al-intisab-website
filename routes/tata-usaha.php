<?php 

use Illuminate\Support\Facades\Route;

Route::get('/tu', function() {
  echo 'Halaman tu';
})->middleware(['auth', 'role:tu']);