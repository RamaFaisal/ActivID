<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\PemesananTiketKonser;
use Illuminate\Http\Request;

class VerifikasiTiketController extends Controller
{
    public function index()
    {
        $pesanan = PemesananTiketKonser::whereHas('jenisTiket.konser', function ($q) {
            $q->where('id_user', auth()->id());
        })->with(['user', 'jenisTiket.konser'])->latest()->get();

        return view('konser.verifikasi.index', compact('pesanan'));
    }

    public function verifikasi($id)
    {
        $pesanan = PemesananTiketKonser::findOrFail($id);
        
        $pesanan->update(['status_pembayaran_tiket' => 'paid']);

        return back()->with('success', 'Pembayaran tiket telah diverifikasi.');
    }
}
