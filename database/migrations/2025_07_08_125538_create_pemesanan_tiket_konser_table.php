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
        Schema::create('pemesanan_tiket_konser', function (Blueprint $table) {
            $table->id('id_pemesanan_tiket');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_jenis_tiket');
            $table->integer('jumlah_tiket_dibeli');
            $table->integer('total_harga_pemesanan');
            $table->timestamp('tanggal_pemesanan_tiket')->useCurrent();
            $table->enum('status_pembayaran_tiket', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->string('qr_code_verifikasi_tiket')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_jenis_tiket')->references('id_jenis_tiket')->on('tiket_konser')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_tiket_konser');
    }
};
