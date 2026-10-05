q<?php

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
        Schema::create('pohons', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pohon');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->string('gambar_pohon')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('manfaat');
            $table->string('nama_pj');
            $table->string('foto_pj')->nullable();
            $table->string('telp_pj')->nullable();
            $table->string('alamat');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('tinggi')->nullable();
            $table->string('tajuk')->nullable();
            $table->json('cocok_untuk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pohons', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
