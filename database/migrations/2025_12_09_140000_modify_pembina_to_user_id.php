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
            // Ganti kolom 'pembina' dari string ke foreign key ke users.id
            $table->dropColumn('pembina');
            $table->unsignedBigInteger('pembina_id')->nullable()->after('status_pembina');
            $table->foreign('pembina_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['pembina_id']);
            $table->dropColumn('pembina_id');
            $table->string('pembina')->nullable()->after('establish_year');
        });
    }
};