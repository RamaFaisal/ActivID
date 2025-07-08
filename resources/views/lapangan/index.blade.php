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
        <div class="max-w-7xl mx-auto px-4 flex flex-col justify-center items-center">
            <h2 class="text-xl font-bold mb-6 text-center">Daftar Lapangan Tersedia</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse ($lapangans as $lapangan)
                <x-venue-card :image="'storage/' . $lapangan->gambar" :title="$lapangan->nama_lapangan"
                    :location="$lapangan->alamat" :category="$lapangan->jenis_lapangan"
                    :price="$lapangan->sesiSewa->isNotEmpty() ? 'Rp' . number_format($lapangan->sesiSewa->min('harga_per_sesi')) : 'Belum tersedia'"
                    :link="route('lapangan.show', $lapangan->slug)" />
                @empty
                <p class="text-center text-gray-500 col-span-3">Tidak ada lapangan yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection