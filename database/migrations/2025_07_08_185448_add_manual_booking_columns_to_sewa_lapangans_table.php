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
        Schema::table('sewa_lapangans', function (Blueprint $table) {
            $table->string('nama_penyewa')->nullable()->after('id_user');
            $table->text('catatan')->nullable()->after('nama_penyewa');
            $table->enum('metode_booking', ['manual', 'online'])->default('online')->after('catatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sewa_lapangans', function (Blueprint $table) {
            $table->dropColumn(['nama_penyewa', 'catatan', 'metode_booking']);
        });
    }
};
