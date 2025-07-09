<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\TiketKonser;
use Illuminate\Http\Request;

class TiketKonserAdminController extends Controller
{
    public function index()
    {
        // $konserSaya = Konser::where('id_user', auth()->id())->pluck('id_konser');
        // $tiket = TiketKonser::with('konser')->whereIn('id_konser', $konserSaya)->get();
        // return view('konser.tiket.index', compact('tiket'));

        $konserSaya = Konser::where('id_user', auth()->id())->with('tiketKonser')->get();
        return view('konser.tiket.index', compact('konserSaya'));
    }

    public function create()
    {
        $konsers = Konser::where('id_user', auth()->id())->get();
        return view('konser.tiket.create', compact('konsers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_konser' => 'required|exists:konsers,id_konser',
            'nama_jenis_tiket' => 'required|string|max:255',
            'harga_tiket' => 'required|integer|min:0',
            'kuota_jenis_tiket' => 'required|integer|min:1',
        ]);

        TiketKonser::create([
            'id_konser' => $request->id_konser,
            'nama_jenis_tiket' => $request->nama_jenis_tiket,
            'harga_tiket' => $request->harga_tiket,
            'kuota_jenis_tiket' => $request->kuota_jenis_tiket,
        ]);

        return redirect()->route('admin-tiket.index')->with('success', 'Jenis tiket berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tiketEdit = TiketKonser::whereHas('konser', function ($q) {
            $q->where('id_user', auth()->id());
        })->findOrFail($id);

        return view('konser.tiket.edit', compact('tiketEdit'));
    }

    public function update(Request $request, $id)
    {
        $tiket = TiketKonser::whereHas('konser', function ($q) {
            $q->where('id_user', auth()->id());
        })->findOrFail($id);

        $request->validate([
            'nama_jenis_tiket' => 'required|string|max:100',
            'harga_tiket' => 'required|numeric|min:0',
            'kuota_jenis_tiket' => 'required|integer|min:1',
        ]);

        $tiket->update($request->only(['nama_jenis_tiket', 'harga_tiket', 'kuota_jenis_tiket']));

        return redirect()->route('admin-tiket.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tiket = TiketKonser::whereHas('konser', function ($q) {
            $q->where('id_user', auth()->id());
        })->findOrFail($id);

        // Cek apakah tiket sudah pernah dipesan
        if ($tiket->pemesanan()->exists()) {
            return back()->with('error', 'Tiket tidak dapat dihapus karena sudah ada pemesanan.');
        }

        $tiket->delete();

        return back()->with('success', 'Tiket berhasil dihapus.');
    }
}
