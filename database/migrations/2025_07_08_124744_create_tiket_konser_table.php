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
        Schema::create('tiket_konser', function (Blueprint $table) {
            $table->id('id_jenis_tiket');
            $table->unsignedBigInteger('id_konser');
            $table->string('nama_jenis_tiket');
            $table->integer('harga_tiket');
            $table->integer('kuota_jenis_tiket');
            $table->timestamps();

            $table->foreign('id_konser')->references('id_konser')->on('konsers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket_konser');
    }
};
