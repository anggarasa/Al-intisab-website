<?php

use Illuminate\Support\Facades\Route;
Route::prefix('master')->name('master.')->middleware(['auth', 'role:master'])->group(function() {

    Route::get('/dashboard-master', function () {
        return view('dashboard-master', [
            'title' => 'dashboard-master'
        ])->name('dashboard');
    });
});
