<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lapangans = auth()->user()->lapangans;
        return view('lapangan.index', compact('lapangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lapangan.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lapangan' => 'required|string|unique:lapangans,nama_lapangan',
            'jenis_lapangan' => 'required|string',
            'alamat' => 'required|string',
            'deskripsi_lapangan' => 'nullable|string',
            'jam_operasional_mulai' => 'required|date_format:H:i',
            'jam_operasional_selesai' => 'required|date_format:H:i|after:jam_operasional_mulai',
            'gambar' => 'nullable|image|max:2048',
        ], [
            'nama_lapangan.required' => 'Nama Lapangan wajib diisi.',
            'nama_lapangan.unique' => 'Nama Lapangan sudah ada.',
            'jenis_lapangan.required' => 'Jenis Lapangan wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'jam_operasional_mulai.required' => 'Jam Operasional Mulai wajib diisi.',
            'jam_operasional_mulai.date_format' => 'Format Jam Operasional Mulai tidak valid.',
            'jam_operasional_selesai.required' => 'Jam Operasional Selesai wajib diisi.',
            'jam_operasional_selesai.date_format' => 'Format Jam Operasional Selesai tidak valid.',
            'jam_operasional_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'gambar.image' => 'Gambar harus berupa file gambar.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $pathGambar = null;

        if ($request->hasFile('gambar')) {
            $pathGambar = $request->file('gambar')->store('lapangan', 'public');
        }

        Lapangan::create([
            'user_id' => auth()->id(),
            'nama_lapangan' => $request->nama_lapangan,
            'jenis_lapangan' => $request->jenis_lapangan,
            'alamat' => $request->alamat,
            'deskripsi_lapangan' => $request->deskripsi_lapangan,
            'jam_operasional_mulai' => $request->jam_operasional_mulai,
            'jam_operasional_selesai' => $request->jam_operasional_selesai,
            'is_active' => true,
            'gambar' => $pathGambar,
        ]);

        return redirect()->route('lapangan-admin.index')->with('success', 'Lapangan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lapangan = Lapangan::with(['user', 'sesiSewa'])->findOrFail($id);
        return view('lapangan.show', compact('lapangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
