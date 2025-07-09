<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\PemesananTiketKonser;
use App\Models\PengajuanKonser;
use App\Models\PengajuanLapangan;
use App\Models\SewaLapangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('superadmin.index');
    }

    public function listPengajuan()
    {
        $pengajuan = PengajuanLapangan::latest()->get();
        return view('superadmin.pengajuan', compact('pengajuan'));
    }

    // Menyetujui pengajuan & membuat akun admin_lapangan
    public function approvePengajuan($id)
    {
        $data = PengajuanLapangan::findOrFail($id);

        if (User::where('email', $data->email)->exists()) {
            return back()->with('error', 'Email sudah digunakan.');
        }

        $user = User::create([
            'name' => $data->nama,
            'email' => $data->email,
            'nomor_telepon' => $data->nomor_telepon,
            'password' => Hash::make('password123'),
        ]);

        $user->syncRoles('admin_lapangan');

        $data->delete();

        return back()->with('success', 'Akun admin lapangan berhasil dibuat.');
    }
    public function rejectPengajuan($id)
    {
        $pengajuan = PengajuanLapangan::findOrFail($id);
        $pengajuan->delete();

        return back()->with('success', 'Pengajuan berhasil ditolak dan dihapus.');
    }

    public function saldo()
    {
        // Fee dari Lapangan
        $bookings = SewaLapangan::with('user', 'lapangan')
            ->where('status_pembayaran_sewa', 'paid')
            ->where('status_verifikasi_admin', 'disetujui')
            ->get();

        $totalFeeLapangan = $bookings->sum('fee_platform');
        $totalTransaksi = $bookings->count();

        // Fee dari Konser
        $transaksi = PemesananTiketKonser::where('status_pembayaran_tiket', 'paid')->get();

        $feeKonser = floor($transaksi->sum('total_harga_pemesanan') * 0.1);

        // Total Fee Developer (gabungan)
        $totalFee = $totalFeeLapangan + $feeKonser;

        return view('superadmin.saldo', compact(
            'bookings',
            'totalFee',
            'totalTransaksi',
            'totalFeeLapangan',
            'feeKonser'
        ));
    }

    public function listPengajuanKonser()
    {
        $pengajuanKonser = PengajuanKonser::latest()->get();
        return view('superadmin.pengajuanKonser', compact('pengajuanKonser'));
    }

    public function approveKonser($id)
    {
        $data = PengajuanKonser::findOrFail($id);

        $data->update([
            'status_pengajuan' => 'disetujui',
        ]);

        if (User::where('email', $data->email)->exists()) {
            return back()->with('error', 'Email sudah digunakan.');
        }

        $user = User::create([
            'name' => $data->nama_pengaju,
            'email' => $data->email_pengaju,
            'nomor_telepon' => $data->nomor_pengaju,
            'password' => Hash::make('password123'),
        ]);

        $user->syncRoles('admin_konser');

        $data->delete();

        return back()->with('success', 'Akun admin lapangan berhasil dibuat.');
    }

    public function rejectKonser($id)
    {
        $pengajuan = PengajuanKonser::findOrFail($id);

        $pengajuan->delete();

        return back()->with('success', 'Pengajuan berhasil ditolak dan dihapus.');
    }

    public function PengajuanKonser()
    {
        $konser = Konser::latest()->get();
        return view('superadmin.konser', compact('konser'));
    }

    public function approve($id_konser)
    {
        $konser = Konser::findOrFail($id_konser);
        $konser->update(['status_konser' => 'aktif']);

        return back()->with('success', 'Konser disetujui dan ditampilkan ke publik.');
    }

    public function reject($id)
    {
        $konser = Konser::findOrFail($id);
        $konser->update(['status_konser' => 'nonaktif']);

        return back()->with('success', 'Konser telah ditolak.');
    }
}
