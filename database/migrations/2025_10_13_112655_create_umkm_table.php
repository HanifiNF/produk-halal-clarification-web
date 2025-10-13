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
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('owner'); // Nama pemilik yang berasal dari tabel users
            $table->string('nama_umkm');
            $table->string('email_umkm')->nullable();
            $table->string('nomor_handphone_umkm')->nullable();
            $table->string('jenis_usaha');
            $table->text('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->year('tahun_berdiri');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};
