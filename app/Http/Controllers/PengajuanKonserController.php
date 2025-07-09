<?php

namespace App\Http\Controllers;

use App\Models\PengajuanKonser;
use App\Models\User;
use Illuminate\Http\Request;

class PengajuanKonserController extends Controller
{
    public function create()
    {
        return view('konser.pengajuan.create');
    }

    // Simpan pengajuan ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengaju' => 'required|string|max:255',
            'email_pengaju' => 'required|email|max:255',
            'nomor_pengaju' => 'required|string|max:20',
            'domisili' => 'required|string|max:100',
            'foto_ktp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoKtpPath = $request->file('foto_ktp')->store('ktp', 'public');

        if (User::where('email', $request->email_pengaju)->exists()) {
            return back()->with('error', 'Email sudah digunakan.');
        }

        PengajuanKonser::create([
            'nama_pengaju' => $request->nama_pengaju,
            'email_pengaju' => $request->email_pengaju,
            'nomor_pengaju' => $request->nomor_pengaju,
            'domisili' => $request->domisili,
            'foto_ktp' => $fotoKtpPath,
            'status_pengajuan' => 'menunggu',
        ]);

        return redirect()->back()->with('success', 'Pengajuan berhasil dikirim. Tunggu persetujuan dari Superadmin.');
    }
}
