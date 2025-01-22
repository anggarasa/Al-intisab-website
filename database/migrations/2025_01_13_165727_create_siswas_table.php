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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('kelas_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('jurusan_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('jenis_kelamin_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('agama_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('nisn')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('nik');
            $table->string('no_hp')->unique();
            $table->string('foto')->nullable();
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('nama_wali')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
