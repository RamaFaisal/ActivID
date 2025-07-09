@extends('layouts.app')

@section('content')
{{-- Hero / Banner --}}
<div class="bg-gray-100">
    <section class="bg-orange-400 mb-10 py-16 text-center">
        <h1 class="text-2xl md:text-4xl text-white font-bold mb-4">BOOKING LAPANGAN ONLINE TERBAIK</h1>
        <a href="{{ route('pengajuan') }}"
            class="inline-flex items-center gap-2 bg-white text-black font-semibold px-6 py-2 rounded-full hover:bg-gray-100 shadow">
            Daftarkan Venue <span class="text-xl">➜</span>
        </a>
    </section>

    {{-- Search Input --}}
    <section class="py-8 text-center mb-10">
        <form action="#" method="GET" class="max-w-xl mx-auto">
            <input type="text" name="search" placeholder="Cari kota atau jenis lapangan..."
                class="w-full border rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-500">
        </form>
    </section>

    {{-- Card Venue dari Database --}}
    <section class="mb-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse ($lapangans as $lapangan)
                    <a href="{{ route('lapangan.show', $lapangan->slug) }}"
                       class="block border rounded p-4 shadow bg-white hover:shadow-lg transition duration-200 cursor-pointer">
                        @if($lapangan->gambar)
                            <img src="{{ asset('storage/' . $lapangan->gambar) }}" alt="Gambar Lapangan"
                                class="w-full h-40 object-cover rounded mb-3">
                        @endif
                        <h3 class="text-lg font-semibold text-gray-800">{{ $lapangan->nama_lapangan }}</h3>
                        <p class="text-sm text-gray-500">{{ $lapangan->jenis_lapangan }}</p>
                        <p class="text-sm text-gray-700">{{ $lapangan->alamat }}</p>
                        <p class="text-sm text-gray-700">Jam Operasional: {{ $lapangan->jam_operasional_mulai }} - {{ $lapangan->jam_operasional_selesai }}</p>
                        <p class="text-sm text-gray-700">
                            Mulai dari:
                            @if($lapangan->sesiSewa->isNotEmpty())
                                Rp{{ number_format($lapangan->sesiSewa->min('harga_per_sesi')) }}
                            @else
                                Belum tersedia
                            @endif
                        </p>
                    </a>
                @empty
                    <p class="text-center text-gray-500 col-span-3">Tidak ada lapangan yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>    
</div>
@endsection