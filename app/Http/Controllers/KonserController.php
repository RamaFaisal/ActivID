<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\PemesananTiketKonser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KonserController extends Controller
{
    public function index()
    {
        $konsers = Konser::where('id_user', auth()->id())->latest()->get();
        return view('konser.indexAdmin', compact('konsers'));
    }
    public function create()
    {
        return view('konser.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_konser' => 'required|string|max:255',
            'artis_konser' => 'required|string|max:255',
            'tanggal_konser' => 'required|date',
            'jam_konser' => 'required',
            'lokasi_konser' => 'required|string|max:255',
            'deskripsi_konser' => 'nullable|string',
            'file_proposal' => 'nullable|mimes:pdf|max:2048',
            'banner_konser' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $proposalPath = $request->hasFile('file_proposal') ? $request->file('file_proposal')->store('proposal', 'public') : null;
        $bannerPath = $request->hasFile('banner_konser') ? $request->file('banner_konser')->store('banner', 'public') : null;

        Konser::create([
            'id_user' => auth()->id(),
            'nama_konser' => $request->nama_konser,
            'artis_konser' => $request->artis_konser,
            'tanggal_konser' => $request->tanggal_konser,
            'jam_konser' => $request->jam_konser,
            'lokasi_konser' => $request->lokasi_konser,
            'deskripsi_konser' => $request->deskripsi_konser,
            'status_konser' => 'menunggu',
            'file_proposal' => $proposalPath,
            'banner_konser' => $bannerPath,
        ]);

        return redirect()->route('konser-admin.index')->with('success', 'Pengajuan konser berhasil dikirim.');
    }

    public function edit($id)
    {
        $konser = Konser::where('id_user', auth()->id())->findOrFail($id);
        return view('konser.edit', compact('konser'));
    }

    public function update(Request $request, $id)
    {
        $konser = Konser::where('id_user', auth()->id())->findOrFail($id);

        $request->validate([
            'nama_konser' => 'required|string',
            'artis_konser' => 'required|string',
            'tanggal_konser' => 'required|date',
            'jam_konser' => 'required',
            'lokasi_konser' => 'required|string',
            'deskripsi_konser' => 'nullable|string',
            'file_proposal' => 'nullable|mimes:pdf|max:2048',
            'banner_konser' => 'nullable|image|max:2048',
        ]);

        // Simpan file baru jika ada
        if ($request->hasFile('file_proposal')) {
            $konser->file_proposal = $request->file('file_proposal')->store('proposal', 'public');
        }

        if ($request->hasFile('banner_konser')) {
            $konser->banner_konser = $request->file('banner_konser')->store('banner', 'public');
        }

        $konser->update([
            'nama_konser' => $request->nama_konser,
            'artis_konser' => $request->artis_konser,
            'tanggal_konser' => $request->tanggal_konser,
            'jam_konser' => $request->jam_konser,
            'lokasi_konser' => $request->lokasi_konser,
            'deskripsi_konser' => $request->deskripsi_konser,
            'file_proposal' => $konser->file_proposal,
            'banner_konser' => $konser->banner_konser,
        ]);

        return redirect()->route('konser-admin.index')->with('success', 'Konser berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $konser = Konser::where('id_user', auth()->id())->findOrFail($id);

        if ($konser->tiketKonser()->has('pemesanan')->exists()) {
            return back()->with('error', 'Tidak dapat menghapus konser yang sudah memiliki pemesanan.');
        }

        // Hapus file jika ada
        if ($konser->file_proposal) {
            Storage::disk('public')->delete($konser->file_proposal);
        }

        if ($konser->banner_konser) {
            Storage::disk('public')->delete($konser->banner_konser);
        }

        $konser->delete();

        return redirect()->route('konser.index')->with('success', 'Konser berhasil dihapus.');
    }


    public function adminKonser()
    {
        $konserIds = Konser::where('id_user', Auth::id())->pluck('id_konser');

        $transaksi = PemesananTiketKonser::whereHas('jenisTiket', function ($q) use ($konserIds) {
            $q->whereIn('id_konser', $konserIds);
        })->where('status_pembayaran_tiket', 'paid')->get();

        $totalPendapatan = $transaksi->sum('total_harga_pemesanan');
        $jumlahTiketTerjual = $transaksi->sum('jumlah_tiket_dibeli');
        $potongan = floor($totalPendapatan * 0.1);
        $bersih = $totalPendapatan - $potongan;

        return view('konser.admin.saldo', compact('totalPendapatan', 'potongan', 'bersih', 'jumlahTiketTerjual'));
    }

    // public function BookingTiket()
    // {
    //     $bookings = PemesananTiketKonser::with('jenisTiket.konser')
    //         ->where('id_pengguna', auth()->id())
    //         ->orderBy('tanggal_pemesanan_tiket', 'desc')
    //         ->get();

    //     return view('booking.index', compact('bookings'));
    // }
}
