@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    @if($konser->banner_konser)
        <img src="{{ asset('storage/' . $konser->banner_konser) }}" alt="Banner Konser" class="w-full mb-4 rounded">
    @endif
    <h1 class="text-3xl font-bold mb-4 text-blue-700">{{ $konser->nama_konser }}</h1>

    <div class="mb-2 text-gray-700">
        <strong>Artis:</strong> {{ $konser->artis_konser }}
    </div>
    <div class="mb-2 text-gray-700">
        <strong>Tanggal:</strong> {{ $konser->tanggal_konser }}
    </div>
    <div class="mb-2 text-gray-700">
        <strong>Jam:</strong> {{ $konser->jam_konser }}
    </div>
    <div class="mb-2 text-gray-700">
        <strong>Lokasi:</strong> {{ $konser->lokasi_konser }}
    </div>

    <div class="mt-4 text-gray-800">
        <strong>Deskripsi:</strong>
        <p class="mt-1">{{ $konser->deskripsi_konser }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('pemesanan.tiket.create', $konser->slug)}}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Booking Tiket
        </a>
    </div>
</div>
@endsection