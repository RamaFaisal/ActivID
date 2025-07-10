@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Riwayat Pemesanan Tiket Konser</h2>

    @if($bookings->isEmpty())
        <p class="text-gray-500">Belum ada pemesanan tiket.</p>
    @else
        @foreach($bookings as $booking)
        <div class="bg-white p-4 rounded shadow mb-4">
            <p><strong>Konser:</strong> {{ $booking->jenisTiket->konser->nama_konser }}</p>
            <p><strong>Jenis Tiket:</strong> {{ $booking->jenisTiket->nama_jenis_tiket }}</p>
            <p><strong>Jumlah Tiket:</strong> {{ $booking->jumlah_tiket_dibeli }}</p>
            <p><strong>Total Bayar:</strong> Rp{{ number_format($booking->total_harga_pemesanan) }}</p>
            <p><strong>Status Pembayaran:</strong>
                @if($booking->status_pembayaran_tiket == 'paid')
                    <span class="text-green-600 font-semibold">Lunas</span>
                @elseif($booking->status_pembayaran_tiket == 'pending')
                    <span class="text-yellow-600 font-semibold">Menunggu Pembayaran</span>
                @else
                    <span class="text-red-600 font-semibold">Dibatalkan</span>
                @endif
            </p>
            <p><strong>Status Check-in:</strong>
                @if($booking->is_verified)
                    <span class="text-green-600 font-semibold">Sudah Check-in</span>
                @else
                    <span class="text-gray-600 font-semibold">Belum Check-in</span>
                @endif
            </p>

            @if($booking->status_pembayaran_tiket == 'paid')
                <div class="mt-3">
                    <img src="{{ asset('storage/qrcode/' . $booking->qr_code_verifikasi_tiket) }}" alt="QR Code" width="120">
                    <p class="text-sm text-gray-500">Kode: {{ $booking->qr_code_verifikasi_tiket }}</p>
                </div>
            @endif
        </div>
        @endforeach
    @endif
</div>
@endsection
