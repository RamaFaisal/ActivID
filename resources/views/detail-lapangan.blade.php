@extends('layouts.app')

@section('title', 'Stadium Citarum – ActivID')

@section('content')

{{-- Breadcrumbs Header --}}
<x-section-header title="Stadium Citarum" />

<section class="py-10 px-6 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- Konten Kiri (2 kolom) --}}
    <div class="md:col-span-2 space-y-6">
        {{-- Detail Gambar + Deskripsi --}}
        <x-lapangan-detail-card image="images/stadioncitarum.jpg" title="Stadium Citarum" location="Jakarta Pusat"
            rating="4.8" :categories="['Futsal', 'Badminton']"
            description="Stadium Citarum adalah salah satu lapangan terbaik yang cocok digunakan untuk olahraga futsal dan badminton dengan fasilitas lengkap dan lokasi strategis."
            :rules="[
                'Wajib membawa identitas saat tiba.',
                'Diperkenankan membawa minum pribadi.',
                'Tidak diperkenankan merokok di dalam area.',
                'Tidak diperkenankan membawa senjata tajam.',
                'Dilarang menimbulkan suara keras di area lapangan.'
            ]" />

        {{-- Lokasi Venue --}}
        <x-map-box alamat="Jl. Imam Bonjol No.207, Pendrikan Kidul, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah" />

        {{-- Fasilitas Venue --}}
        <x-fasilitas-grid :items="[
            'Café & Resto',
            'Toilet',
            'Ruang Ganti',
            'Parkir Motor',
            'Parkir Mobil',
            'Musala'
        ]" />
    </div>

    {{-- Sisi Kanan: Harga --}}
    <div>
        <x-harga-box price="Rp1.500.000" url="/cek-ketersediaan" />
    </div>

</section>

@endsection