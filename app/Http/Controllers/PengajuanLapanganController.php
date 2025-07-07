<?php

namespace App\Http\Controllers;

use App\Models\PengajuanLapangan;
use App\Models\User;
use Illuminate\Http\Request;

class PengajuanLapanganController extends Controller
{
    public function create()
    {
        return view('pengajuan');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'nomor_telepon' => 'required',
            'domisili' => 'required',
            'jenis_pengajuan' => 'required',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return back()->with('error', 'Email sudah digunakan.');
        }

        PengajuanLapangan::create($request->all());

        return redirect()->back()->with('success', 'Pengajuan berhasil dikirim');
    }
}
