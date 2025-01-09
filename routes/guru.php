<?php 

use Illuminate\Support\Facades\Route;

Route::get('/guru', function() {
  echo 'Halaman guru';
})->middleware(['auth', 'role:guru']);