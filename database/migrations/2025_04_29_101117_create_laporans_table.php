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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('lokasi_pohon');
            $table->string('waktu_ditemukan');
            $table->longText('deskripsi_kerusakan');
            $table->string('foto_kerusakan')->nullable();
            $table->string('nama_pelapor');
            $table->string('telp');
            $table->string('email');
            $table->enum('status', ['terkirim', 'diproses', 'selesai', 'ditolak'])->default('terkirim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
