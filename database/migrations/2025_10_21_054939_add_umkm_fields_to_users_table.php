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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_umkm')->nullable()->after('phone_number');
            $table->text('address')->nullable()->after('nama_umkm');
            $table->string('city')->nullable()->after('address');
            $table->string('province')->nullable()->after('city');
            $table->year('establish_year')->nullable()->after('province');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama_umkm', 'address', 'city', 'province', 'establish_year']);
        });
    }
};
