<?php

use App\Livewire\Pages\Master\Dashboard;
use App\Livewire\Pages\Master\Data\Agama\ManajemenAgama;
use App\Livewire\Pages\Master\Data\JenisPtk\JenisPtk;
use App\Livewire\Pages\Master\Data\Jurusan\ManajemenJurusan;
use App\Livewire\Pages\Master\Data\ManajemenData;
use App\Livewire\Pages\Master\Identitas\ManajemenIdentitasSekolah;
use App\Livewire\Pages\Master\Kelas\ManajemenKelas;
use App\Livewire\Pages\Master\Kurikulum\ManajemenKurikulum;
use App\Livewire\Pages\Master\Pembayaran\InputPembayaran\InputPembayaran;
use App\Livewire\Pages\Master\Pembayaran\JenisPembayaran\ManajemenJenisPembayaran;
use App\Livewire\Pages\Master\RiwayatPembayaran\RiwayatPembayaran;
use App\Livewire\Pages\Master\User\Guru\ManajemenGuru;
use App\Livewire\Pages\Master\User\ManajemenUser;
use App\Livewire\Pages\Master\User\Siswa\ManajemenSiswa;
use Illuminate\Support\Facades\Route;
Route::prefix('master')->name('master.')->middleware(['auth', 'role:master'])->group(function() {
    // Dasboard master
    Route::get('/dashboard-master', Dashboard::class)->name('dashboard-master');

    // Manajemen
    Route::prefix('manajemen')->name('manajemen.')->group(function() {
        // Jenis PTK
        Route::get('/jenis-ptk', JenisPtk::class)->name('jenis-ptk');

        // manajemen jurusan
        Route::get('/jurusan', ManajemenJurusan::class)->name('jurusan');

        // manajemen kelas
        Route::get('/kelas', ManajemenKelas::class)->name('kelas');

        // manajemen agama
        Route::get('/agama', ManajemenAgama::class)->name('agama');

        // Manajemen user
        Route::get('/user', ManajemenUser::class)->name('user');

        // manajemen siswa
        Route::get('/siswa', ManajemenSiswa::class)->name('siswa');

        // manajemen guru
        Route::get('/guru', ManajemenGuru::class)->name('guru');

        // manajemen kurikulum
        Route::get('/kurikulum', ManajemenKurikulum::class)->name('kurikulum');

        // identitas sekolah
        Route::get('/identitas-sekolah', ManajemenIdentitasSekolah::class)->name('identitas-sekolah');
        
        // manajemen jenis pembayaran
        Route::get('/jenis-pembayaran', ManajemenJenisPembayaran::class)->name('jenis-pembayaran');
    });

    // input Pembayaran
    Route::get('/input-pembayaran', InputPembayaran::class)->name('input-pembayaran');

    // Riwayat pembayaran
    Route::get('/riwayat-pembayaran', RiwayatPembayaran::class)->name('riwayat-pembayaran');
});
