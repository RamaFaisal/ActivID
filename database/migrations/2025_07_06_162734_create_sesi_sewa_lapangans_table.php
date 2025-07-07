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
        Schema::create('sesi_sewa_lapangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lapangan_id')->constrained('lapangans')->onDelete('cascade');
            $table->date('tanggal_sesi');
            $table->time('jam_mulai_sesi');
            $table->time('jam_selesai_sesi');
            $table->integer('harga_per_sesi');
            $table->boolean('is_available')->default(true);
            $table->boolean('is_booked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_sewa_lapangans');
    }
};
