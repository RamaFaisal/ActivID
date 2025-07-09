@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Tiket Saya</h2>

    @forelse($pesanan as $item)
    <div class="bg-white p-4 rounded shadow mb-4">
        <p><strong>Konser:</strong> {{ $item->jenisTiket->konser->nama_konser }}</p>
        <p><strong>Jenis Tiket:</strong> {{ $item->jenisTiket->nama_jenis_tiket }}</p>
        <p><strong>Jumlah:</strong> {{ $item->jumlah_tiket_dibeli }}</p>
        <p><strong>Total:</strong> Rp{{ number_format($item->total_harga_pemesanan) }}</p>
        <p><strong>Status:</strong> 
            <span class="{{ $item->status_pembayaran_tiket === 'paid' ? 'text-green-600' : 'text-yellow-600' }}">
                {{ ucfirst($item->status_pembayaran_tiket) }}
            </span>
        </p>

        @if($item->tiketIndividu->count())
        <h3 class="text-lg font-bold mt-4">QR Tiket:</h3>
        <ul class="grid grid-cols-2 gap-4 mt-2">
            @foreach($item->tiketIndividu as $t)
                <li class="border p-3 rounded bg-white shadow flex flex-col items-center text-center">
                    <img src="{{ asset('storage/qrcode/' . $t->qr_code . '.svg') }}" width="100">
                    <p class="text-sm text-gray-600 mt-1">{{ $t->qr_code }}</p>
                    <p class="text-xs {{ $t->is_verified ? 'text-green-600' : 'text-gray-600' }}">
                        {{ $t->is_verified ? 'Sudah Check-in' : 'Belum Check-in' }}
                    </p>
                </li>
            @endforeach
        </ul>
        @endif
    </div>
    @empty
        <p class="text-gray-600">Belum ada pembelian tiket.</p>
    @endforelse
</div>
@endsection
