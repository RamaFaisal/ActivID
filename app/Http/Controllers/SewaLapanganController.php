<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\SesiSewaLapangan;
use App\Models\SewaLapangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SewaLapanganController extends Controller
{
    public function store(Request $request, $sesi_id)
    {
        $sesi = SesiSewaLapangan::with('lapangan')->findOrFail($sesi_id);

        if (!$sesi->is_available || $sesi->is_booked) {
            return back()->with('error', 'Sesi tidak tersedia.');
        }

        $durasi = Carbon::parse($sesi->jam_mulai_sesi)
            ->diffInMinutes(Carbon::parse($sesi->jam_selesai_sesi));

        $harga = $sesi->harga_per_sesi;
        $fee = intval($harga * 0.10);
        $diterima = $harga - $fee;

        $booking = SewaLapangan::create([
            'id_user' => Auth::id(),
            'id_lapangan' => $sesi->lapangan->id,
            'tanggal_sewa' => $sesi->tanggal_sesi,
            'jam_mulai_sewa' => $sesi->jam_mulai_sesi,
            'jam_selesai_sewa' => $sesi->jam_selesai_sesi,
            'durasi_sewa' => $durasi,
            'total_harga_sewa' => $harga,
            'fee_platform' => $fee,
            'jumlah_diterima' => $diterima,
            'status_pembayaran_sewa' => 'paid',
            'status_verifikasi_admin' => 'menunggu',
            'status_checkin' => false,
            'metode_pembayaran' => 'transfer_bank',
        ]);

        return redirect()->route('lapangan.show', $sesi->lapangan->slug)
            ->with('success', 'Booking berhasil! Menunggu verifikasi admin.');
    }

    public function approve($id)
    {
        $booking = SewaLapangan::findOrFail($id);

        if ($booking->status_verifikasi_admin !== 'menunggu') {
            return back()->with('error', 'Booking sudah diverifikasi.');
        }

        // Generate QR
        $qrContent = 'BookingID:' . $booking->id_sewa;
        $qrFile = 'qr/qr-' . $booking->id_sewa . '.svg';
        $svg = QrCode::format('svg')->size(300)->generate($qrContent);
        Storage::put('public/' . $qrFile, $svg);

        $booking->update([
            'status_verifikasi_admin' => 'disetujui',
            'qr_code_verifikasi_sewa' => $qrFile,
        ]);

        // Tandai sesi tidak tersedia
        $booking->lapangan->sesiSewa()
            ->where('tanggal_sesi', $booking->tanggal_sewa)
            ->where('jam_mulai_sesi', $booking->jam_mulai_sewa)
            ->update([
                'is_booked' => true,
                'is_available' => false,
            ]);

        return back()->with('success', 'Booking disetujui dan QR telah dibuat.');
    }

    public function scanView()
    {
        return view('booking.scan');
    }

    public function scanProcess(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:sewa_lapangans,id_sewa',
        ]);

        $booking = SewaLapangan::with('user', 'lapangan')->find($request->booking_id);

        // Cek apakah booking belum diverifikasi
        if ($booking->status_verifikasi_admin !== 'disetujui') {
            return back()->with('error', 'Booking belum disetujui admin.');
        }

        $adminId = auth()->id(); // admin yang login
        $pemilikLapanganId = $booking->lapangan->user_id;

        if ($adminId !== $pemilikLapanganId) {
            return back()->with('error', 'QR ini bukan untuk lapangan Anda.');
        }

        // Cek jika sudah check-in
        if ($booking->status_checkin) {
            return back()->with('error', 'Booking ini sudah check-in sebelumnya.');
        }

        // Update status check-in
        $booking->update([
            'status_checkin' => true,
            'checkin_at' => now(),
        ]);

        return back()->with('success', 'Check-in berhasil untuk Booking atas nama ' . $booking->user->name);
    }

    public function adminBookingIndex()
    {
        $adminId = auth()->id();

        // Ambil hanya booking untuk lapangan milik admin yang login
        $bookings = SewaLapangan::with(['user', 'lapangan'])
            ->whereHas('lapangan', function ($query) use ($adminId) {
                $query->where('user_id', $adminId); // hanya lapangan milik admin
            })
            ->orderBy('tanggal_pemesanan', 'desc')
            ->get();

        return view('booking.index', compact('bookings'));
    }

    public function userBookings()
    {
        $bookings = SewaLapangan::with('lapangan')
            ->where('id_user', auth()->id())
            ->orderBy('tanggal_pemesanan', 'desc')
            ->get();

        return view('booking.index', compact('bookings'));
    }

    public function dompetAdmin()
    {
        $adminId = auth()->id();

        // Ambil semua booking yang sudah disetujui & dibayar
        $bookings = \App\Models\SewaLapangan::whereHas('lapangan', function ($q) use ($adminId) {
            $q->where('user_id', $adminId); // asumsi 1 admin 1 lapangan
        })
            ->where('status_pembayaran_sewa', 'paid')
            ->where('status_verifikasi_admin', 'disetujui')
            ->get();

        $totalPendapatan = $bookings->sum('jumlah_diterima');
        $jumlahTransaksi = $bookings->count();

        return view('lapangan.dompet', compact('bookings', 'totalPendapatan', 'jumlahTransaksi'));
    }

    public function createManual()
    {
        $sesiTersedia = SesiSewaLapangan::whereHas('lapangan', function ($q) {
            $q->where('user_id', auth()->id());
        })->where('is_available', true)->where('is_booked', false)->get();

        return view('lapangan.manual', compact('sesiTersedia'));
    }

    public function storeManual(Request $request)
    {
        $request->validate([
            'sesi_id' => 'required|exists:sesi_sewa_lapangans,id',
            'nama_penyewa' => 'required|string|max:100',
            'catatan' => 'nullable|string|max:255',
        ]);

        $sesi = SesiSewaLapangan::with('lapangan')->findOrFail($request->sesi_id);

        // Hitung durasi
        $mulai = strtotime($sesi->jam_mulai_sesi);
        $selesai = strtotime($sesi->jam_selesai_sesi);
        $durasi = ($selesai - $mulai) / 60;

        $total = $sesi->harga_per_sesi;
        $fee = floor($total * 0.1);
        $bersih = $total - $fee;

        // Tandai sesi sudah dibooking
        $sesi->update(['is_booked' => true]);

        // Simpan ke sewa_lapangans
        SewaLapangan::create([
            'id_user' => null,
            'id_lapangan' => $sesi->lapangan_id,
            'nama_penyewa' => $request->nama_penyewa,
            'catatan' => $request->catatan,
            'tanggal_sewa' => $sesi->tanggal_sesi,
            'jam_mulai_sewa' => $sesi->jam_mulai_sesi,
            'jam_selesai_sewa' => $sesi->jam_selesai_sesi,
            'durasi_sewa' => $durasi,
            'total_harga_sewa' => $total,
            'fee_platform' => $fee,
            'jumlah_diterima' => $bersih,
            'status_pembayaran_sewa' => 'paid',
            'status_verifikasi_admin' => 'disetujui',
            'status_checkin' => true,
            'metode_pembayaran' => 'langsung',
            'metode_booking' => 'manual',
            'tanggal_pemesanan' => now(),
        ]);

        return redirect()->route('sesi.index')->with('success', 'Booking manual berhasil disimpan.');
    }
}
