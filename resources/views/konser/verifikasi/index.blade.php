@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Verifikasi Pembayaran Tiket</h2>

    @if(session('success'))
        <div class="bg-green-100 p-3 rounded text-green-700 mb-4">{{ session('success') }}</div>
    @endif

    @forelse($pesanan as $item)
    <div class="bg-white p-4 rounded shadow mb-4">
        <p><strong>Nama:</strong> {{ $item->user->name }} | <strong>Email:</strong> {{ $item->user->email }}</p>
        <p><strong>Konser:</strong> {{ $item->jenisTiket->konser->nama_konser }}</p>
        <p><strong>Jenis Tiket:</strong> {{ $item->jenisTiket->nama_jenis_tiket }}</p>
        <p><strong>Jumlah:</strong> {{ $item->jumlah_tiket_dibeli }} | <strong>Total:</strong> Rp{{ number_format($item->total_harga_pemesanan) }}</p>
        <p class="text-sm text-yellow-600 mb-2"><strong>Status:</strong> {{ $item->status_pembayaran_tiket }}</p>

        <form method="POST" action="{{ route('admin.verifikasi.proses', $item->id_pemesanan_tiket) }}">
            @csrf
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                Verifikasi Sekarang
            </button>
        </form>
    </div>
    @empty
    <p class="text-gray-500">Belum ada pesanan yang menunggu verifikasi.</p>
    @endforelse
</div>
@endsection
