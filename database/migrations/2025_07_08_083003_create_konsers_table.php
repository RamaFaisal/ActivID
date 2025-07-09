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
        Schema::create('konsers', function (Blueprint $table) {
            $table->id('id_konser');

            $table->unsignedBigInteger('id_user'); // Admin konser
            $table->string('nama_konser');
            $table->string('artis_konser');
            $table->date('tanggal_konser');
            $table->time('jam_konser');
            $table->string('lokasi_konser');
            $table->text('deskripsi_konser')->nullable();
            $table->integer('jumlah_tiket_konser');
            $table->enum('status_konser', ['menunggu', 'aktif', 'nonaktif'])->default('menunggu');
            $table->string('file_proposal')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsers');
    }
};
