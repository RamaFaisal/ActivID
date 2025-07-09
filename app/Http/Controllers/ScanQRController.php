<?php

namespace App\Http\Controllers;

use App\Models\PemesananTiketKonser;
use App\Models\TiketIndividu;
use Illuminate\Http\Request;

class ScanQRController extends Controller
{
    public function check($kode)
    {
        $tiket = TiketIndividu::with('pemesanan.jenisTiket.konser', 'pemesanan.user')
            ->where('qr_code', $kode)
            ->first();

        if (!$tiket) {
            return view('konser.verifikasi.result', [
                'status' => 'error',
                'message' => 'QR Code tidak ditemukan atau tidak valid.',
            ]);
        }

        if ($tiket->pemesanan->status_pembayaran_tiket !== 'paid') {
            return view('konser.verifikasi.result', [
                'status' => 'error',
                'message' => 'Tiket belum dibayar.',
            ]);
        }

        if ($tiket->is_verified) {
            return view('konser.verifikasi.result', [
                'status' => 'warning',
                'message' => 'Tiket ini sudah digunakan untuk check-in sebelumnya.',
                'tiket' => $tiket,
            ]);
        }

        // Tandai sudah check-in
        $tiket->update(['is_verified' => true]);

        return view('konser.verifikasi.result', [
            'status' => 'success',
            'message' => 'Check-in berhasil!',
            'tiket' => $tiket,
        ]);
    }
}
