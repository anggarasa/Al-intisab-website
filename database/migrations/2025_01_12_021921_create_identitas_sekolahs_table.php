<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('identitas_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->integer('npsn')->length(10);
            $table->string('alamat_sekolah');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kabupaten_kota');
            $table->string('provinsi');
            $table->integer('kode_pos');
            $table->string('no_telpone');
            $table->string('email');
            $table->string('akreditasi');
            $table->string('kepala_sekolah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas_sekolahs');
    }
};
