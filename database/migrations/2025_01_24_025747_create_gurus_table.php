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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('jenis_kelamin_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('jenis_ptk_id')->nullable()->constrained('jenis_ptks')->onDelete('set null');
            $table->foreignId('agama_id')->nullable()->constrained('agamas')->onDelete('set null');
            $table->string('name');
            $table->string('nip')->unique();
            $table->string('nik')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_hp')->unique();
            $table->string('foto')->nullable();
            $table->enum('status_kepegawaian', ['AKTIF', 'TIDAK AKTIF'])->default('AKTIF');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
