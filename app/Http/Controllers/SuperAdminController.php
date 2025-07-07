<?php

namespace App\Http\Controllers;

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
        $bookings = SewaLapangan::with('user', 'lapangan')
            ->where('status_pembayaran_sewa', 'paid')
            ->where('status_verifikasi_admin', 'disetujui')
            ->get();

        $totalFee = $bookings->sum('fee_platform');
        $totalTransaksi = $bookings->count();

        return view('superadmin.saldo', compact('bookings', 'totalFee', 'totalTransaksi'));
    }
}
