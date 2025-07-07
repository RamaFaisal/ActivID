<?php

namespace App\Http\Controllers;

use App\Models\SesiSewaLapangan;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class SesiSewaController extends Controller
{
    public function index()
    {
        $lapangans = auth()->user()->lapangans()->with('sesiSewa.sewa.user')->get();
        return view('sesi.index', compact('lapangans'));
    }

    public function create()
    {
        $lapangans = auth()->user()->lapangans;
        return view('sesi.create', compact('lapangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id',
            'tanggal_sesi' => 'required|date',
            'jam_mulai_sesi' => 'required',
            'jam_selesai_sesi' => 'required|after:jam_mulai_sesi',
            'harga_per_sesi' => 'required|integer|min:0',
        ]);

        // pastikan lapangan milik pengelola tersebut
        if (!auth()->user()->lapangans->pluck('id')->contains($request->lapangan_id)) {
            abort(403, 'Lapangan ini bukan milik Anda.');
        }

        SesiSewaLapangan::create([
            'lapangan_id' => $request->lapangan_id,
            'tanggal_sesi' => $request->tanggal_sesi,
            'jam_mulai_sesi' => $request->jam_mulai_sesi,
            'jam_selesai_sesi' => $request->jam_selesai_sesi,
            'harga_per_sesi' => $request->harga_per_sesi,
            'is_available' => true,
            'is_booked' => false,
        ]);

        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $sesi = SesiSewaLapangan::findOrFail($id);

        // pastikan lapangan milik user login
        if (!auth()->user()->lapangans->pluck('id')->contains($sesi->lapangan_id)) {
            abort(403);
        }

        $lapangans = auth()->user()->lapangans;
        return view('sesi.edit', compact('sesi', 'lapangans'));
    }

    public function update(Request $request, $id)
    {
        $sesi = SesiSewaLapangan::findOrFail($id);

        if (!auth()->user()->lapangans->pluck('id')->contains($sesi->lapangan_id)) {
            abort(403);
        }

        $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id',
            'tanggal_sesi' => 'required|date',
            'jam_mulai_sesi' => 'required',
            'jam_selesai_sesi' => 'required|after:jam_mulai_sesi',
            'harga_per_sesi' => 'required|integer|min:0',
        ]);

        $sesi->update($request->all());

        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sesi = SesiSewaLapangan::findOrFail($id);

        if (!auth()->user()->lapangans->pluck('id')->contains($sesi->lapangan_id)) {
            abort(403);
        }

        $sesi->delete();

        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil dihapus.');
    }
}