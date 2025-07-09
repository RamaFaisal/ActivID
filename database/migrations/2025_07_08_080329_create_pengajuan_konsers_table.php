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
        Schema::create('pengajuan_konsers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengaju');
            $table->string('email_pengaju');
            $table->string('nomor_pengaju');
            $table->string('domisili');
            $table->string('foto_ktp')->nullable();

            $table->enum('status_pengajuan', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_konsers');
    }
};
