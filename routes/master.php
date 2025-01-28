<?php

use App\Livewire\Pages\Master\Dashboard;
use App\Livewire\Pages\Master\Data\ManajemenData;
use App\Livewire\Pages\Master\User\ManajemenUser;
use Illuminate\Support\Facades\Route;
Route::prefix('master')->name('master.')->middleware(['auth', 'role:master'])->group(function() {
    // Dasboard master
    Route::get('/dashboard-master', Dashboard::class)->name('dashboard-master');

    // Manajemen
    Route::prefix('manajemen')->name('manajemen.')->group(function() {
        // Manajemdn data
        Route::get('/data', ManajemenData::class)->name('data');

        // Manajemen user
        Route::get('/user', ManajemenUser::class)->name('user');
    });
});
