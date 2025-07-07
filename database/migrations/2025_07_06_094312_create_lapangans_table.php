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
        Schema::create('lapangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Pengelola
            $table->string('nama_lapangan');
            $table->string('jenis_lapangan');
            $table->text('deskripsi_lapangan')->nullable();
            $table->string('alamat');
            $table->boolean('is_active')->default(true); // status buka/tutup
            $table->time('jam_operasional_mulai');
            $table->time('jam_operasional_selesai');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapangans');
    }
};
