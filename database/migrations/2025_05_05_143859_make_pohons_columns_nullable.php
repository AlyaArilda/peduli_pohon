<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pohons', function (Blueprint $table) {
            $table->string('gambar_pohon')->nullable()->change();
            $table->string('foto_pj')->nullable()->change();
            // jika ada field lain yang perlu nullable, tambahkan di sini:
            // $table->string('nama_pj')->nullable()->change();
            // $table->string('alamat')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pohons', function (Blueprint $table) {
            $table->string('gambar_pohon')->nullable(false)->change();
            $table->string('foto_pj')->nullable(false)->change();
            // rollback untuk field lain juga:
            // $table->string('nama_pj')->nullable(false)->change();
            // $table->string('alamat')->nullable(false)->change();
        });
    }
};
