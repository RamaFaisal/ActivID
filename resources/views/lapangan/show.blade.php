@extends('layouts.app')

@section('title', 'Booking Lapangan ' . $lapangan->nama_lapangan)

@section('content')

{{-- Notifikasi Flash Message --}}
@if (session('success'))
    <div class="max-w-3xl mx-auto mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="max-w-3xl mx-auto mb-4 p-4 bg-red-100 border border-red-400 text-red-800 rounded">
        {{ session('error') }}
    </div>
@endif

{{-- Header --}}
<x-section-header :title="$lapangan->nama_lapangan" />

<section class="py-10 px-6 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- Kolom Kiri --}}
    <div class="md:col-span-2 space-y-6">
        
        {{-- Detail Gambar + Deskripsi --}}
        <x-lapangan-detail-card
            :image="asset('storage/' . $lapangan->gambar)"
            :title="$lapangan->nama_lapangan"
            :location="$lapangan->alamat"
            :rating="$lapangan->rating ?? '4.8'"
            :categories="[$lapangan->jenis_lapangan]"
            :description="$lapangan->deskripsi_lapangan"
        />

        {{-- Lokasi Venue --}}
        <x-map-box :alamat="$lapangan->alamat" />

        {{-- Jadwal Sesi --}}
        <div id="sesi" class="p-6 border rounded bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Jadwal Sesi Tersedia</h3>

            @if($lapangan->sesiSewa->isEmpty())
                <p class="text-sm text-gray-500">Belum ada sesi tersedia.</p>
            @else
                <ul class="space-y-3">
                    @foreach($lapangan->sesiSewa as $sesi)
                        <li class="mb-2 border p-2 rounded bg-white shadow-sm text-sm">
                            <strong>{{ $sesi->tanggal_sesi }}</strong> | 
                            {{ $sesi->jam_mulai_sesi }} - {{ $sesi->jam_selesai_sesi }} |
                            Rp{{ number_format($sesi->harga_per_sesi) }}

                            @if($sesi->is_booked)
                                <span class="ml-2 text-red-600">Terbooking</span>
                            @elseif(!$sesi->is_available)
                                <span class="ml-2 text-yellow-600">Tidak Tersedia</span>
                            @else
                                <a href="{{ route('sewa.checkout', $sesi->id) }}"
                                    class="ml-2 text-green-600 underline">Booking</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- Kolom Kanan: Harga --}}
    <div>
        <x-harga-box :price="'Rp' . number_format($lapangan->sesiSewa->min('harga_per_sesi') ?? 0)" href="#sesi" />
    </div>

</section>
@endsection
