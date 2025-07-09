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
        Schema::create('tiket_individu', function (Blueprint $table) {
            $table->id('id_tiket_individu');
            $table->unsignedBigInteger('id_pemesanan_tiket');
            $table->string('qr_code');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();

            $table->foreign('id_pemesanan_tiket')->references('id_pemesanan_tiket')->on('pemesanan_tiket_konser')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket_individu');
    }
};
