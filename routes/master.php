<?php

use App\Livewire\Pages\Master\Dashboard;
use Illuminate\Support\Facades\Route;
Route::prefix('master')->name('master.')->middleware(['auth', 'role:master'])->group(function() {

    Route::get('/dashboard-master', Dashboard::class);
});
