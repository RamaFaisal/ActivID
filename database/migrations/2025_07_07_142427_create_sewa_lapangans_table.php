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
        Schema::create('sewa_lapangans', function (Blueprint $table) {
            $table->id('id_sewa');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_lapangan');

            $table->date('tanggal_sewa');
            $table->time('jam_mulai_sewa');
            $table->time('jam_selesai_sewa');
            $table->integer('durasi_sewa'); // dalam menit

            $table->integer('total_harga_sewa');
            $table->integer('fee_platform'); // 10% untuk developer
            $table->integer('jumlah_diterima'); // 90% untuk admin lapangan

            $table->enum('status_pembayaran_sewa', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->enum('status_verifikasi_admin', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');

            $table->boolean('status_checkin')->default(false);
            $table->timestamp('checkin_at')->nullable();

            $table->string('metode_pembayaran')->default('transfer_bank');
            $table->string('qr_code_verifikasi_sewa')->nullable();
            $table->timestamp('tanggal_pemesanan')->useCurrent();

            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_lapangan')->references('id')->on('lapangans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewa_lapangans');
    }
};
