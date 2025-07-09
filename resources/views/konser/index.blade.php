@extends('layouts.app')

@section('content')
<div class="bg-gray-100">
    {{-- Hero Section --}}
    <section class="bg-orange-400 mb-10 py-16 text-center">
        <h1 class="text-2xl md:text-4xl text-white font-bold mb-4">BOOKING KONSER ONLINE TERBAIK</h1>
        <a href="{{ route('pengajuan.konser.create') }}"
            class="inline-flex items-center gap-2 bg-white text-black font-semibold px-6 py-2 rounded-full hover:bg-gray-100 shadow">
            Daftarkan Konser <span class="text-xl">➜</span>
        </a>
    </section>

    {{-- Search Input --}}
    <section class="py-8 text-center mb-10">
        <form action="#" method="GET" class="max-w-xl mx-auto">
            <input type="text" name="search" placeholder="Cari kota atau nama konser..."
                class="w-full border rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-500">
        </form>
    </section>

    {{-- List Konser --}}
    <section class="mb-16">
        <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($konsers as $konser)
                <a href="{{ route('konser.public.show', $konser->slug) }}" class="border rounded p-4 shadow bg-white">
                    @if($konser->banner_konser)
                        <img src="{{ asset('storage/' . $konser->banner_konser) }}" alt="Banner Konser"
                            class="w-full h-40 object-cover rounded mb-3">
                    @endif
                    <h3 class="text-lg font-semibold text-gray-800">{{ $konser->nama_konser }}</h3>
                    <p class="text-gray-600 text-sm">Artis: {{ $konser->artis_konser }}</p>
                    <p class="text-gray-600 text-sm">Tanggal: {{ $konser->tanggal_konser }}</p>
                    <p class="text-gray-600 text-sm">Jam: {{ $konser->jam_konser }}</p>
                    <p class="text-gray-600 text-sm">Lokasi: {{ $konser->lokasi_konser }}</p>
                    <p class="text-gray-700 text-sm mt-2">{{ Str::limit($konser->deskripsi_konser, 100) }}</p>
                </a>
            @empty
            <p class="text-center text-gray-500">Tidak ada konser yang tersedia.</p>
            @endforelse
            </div>
        </div>
    </section>
</div>
@endsection