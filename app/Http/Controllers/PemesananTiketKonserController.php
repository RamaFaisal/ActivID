<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\PemesananTiketKonser;
use App\Models\TiketIndividu;
use App\Models\TiketKonser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class PemesananTiketKonserController extends Controller
{
    public function create($slug)
    {
        $konser = Konser::where('slug', $slug)->where('status_konser', 'aktif')->firstOrFail();
        $jenisTiket = TiketKonser::where('id_konser', $konser->id_konser)->get();

        return view('konser.pemesanan.create', compact('konser', 'jenisTiket'));
    }

    public function store(Request $request, $slug)
    {
        $konser = Konser::where('slug', $slug)->firstOrFail();

        $request->validate([
            'id_jenis_tiket' => 'required|exists:tiket_konser,id_jenis_tiket',
            'jumlah_tiket_dibeli' => 'required|integer|min:1'
        ]);

        $jenis = TiketKonser::findOrFail($request->id_jenis_tiket);

        if ($request->jumlah_tiket_dibeli > $jenis->kuota_jenis_tiket) {
            return back()->withErrors(['jumlah_tiket_dibeli' => 'Jumlah tiket melebihi kuota tersedia.']);
        }

        // Hitung total dan QR
        $total = $jenis->harga_tiket * $request->jumlah_tiket_dibeli;
        $kodeQR = strtoupper(Str::random(10));

        // Simpan pemesanan
        $pemesanan = PemesananTiketKonser::create([
            'id_user' => auth()->id(),
            'id_jenis_tiket' => $jenis->id_jenis_tiket,
            'jumlah_tiket_dibeli' => $request->jumlah_tiket_dibeli,
            'total_harga_pemesanan' => $total,
            'status_pembayaran_tiket' => 'pending',
            'qr_code_verifikasi_tiket' => null,
            'is_verified' => false,
        ]);

        for ($i = 0; $i < $request->jumlah_tiket_dibeli; $i++) {
            $qr = strtoupper(Str::random(12));

            // Simpan file PNG QR
            $qrImage = QrCode::format('svg')->size(200)->generate($qr);
            Storage::put("public/qrcode/{$qr}.svg", $qrImage);

            // Simpan ke DB
            TiketIndividu::create([
                'id_pemesanan_tiket' => $pemesanan->id_pemesanan_tiket,
                'qr_code' => $qr,
                'is_verified' => false,
            ]);
        }

        // Kurangi kuota
        $jenis->decrement('kuota_jenis_tiket', $request->jumlah_tiket_dibeli);

        return redirect()->route('tiket.saya')->with('success', 'Pemesanan berhasil! Silakan lanjutkan pembayaran.');
    }
}
