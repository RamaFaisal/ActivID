@extends('layouts.admin')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow text-center">
    @if($status === 'success')
        <h2 class="text-green-600 text-xl font-bold mb-2">{{ $message }}</h2>
        <p><strong>Nama:</strong> {{ $tiket->pemesanan->user->name }}</p>
        <p><strong>Konser:</strong> {{ $tiket->pemesanan->jenisTiket->konser->nama_konser }}</p>
        <p><strong>Jenis Tiket:</strong> {{ $tiket->pemesanan->jenisTiket->nama_jenis_tiket }}</p>
        <p><strong>Jumlah Tiket:</strong> {{ $tiket->pemesanan->jumlah_tiket_dibeli }}</p>
    @elseif($status === 'warning')
        <h2 class="text-yellow-600 text-xl font-bold mb-2">Tiket Sudah Digunakan</h2>
        <p>{{ $message }}</p>
        <p><strong>Nama:</strong> {{ $tiket->pemesanan->user->name }}</p>
        <p><strong>Konser:</strong> {{ $tiket->pemesanan->jenisTiket->konser->nama_konser }}</p>
    @else
        <h2 class="text-red-600 text-xl font-bold mb-2">Gagal</h2>
        <p>{{ $message }}</p>
    @endif
</div>
@endsection