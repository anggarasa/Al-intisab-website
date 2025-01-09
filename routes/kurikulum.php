<?php 

use Illuminate\Support\Facades\Route;

Route::get('/kurikulum', function() {
  echo 'Halaman kurikulum';
})->middleware(['auth', 'role:kurikulum']);