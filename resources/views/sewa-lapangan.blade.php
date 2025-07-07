@extends('layouts.app') {{-- jika kamu punya layout, atau gunakan layout dasar --}}

@section('content')


{{-- Hero / Banner --}}
<div class="bg-gray-100">

    <section class="bg-orange-400 mb-10 py-16 text-center">
        <h1 class="text-2xl md:text-4xl text-white font-bold mb-4">BOOKING LAPANGAN ONLINE TERBAIK</h1>
        <a href="#"
            class="inline-flex items-center gap-2 bg-white text-black font-semibold px-6 py-2 rounded-full hover:bg-gray-100 shadow">
            Daftarkan Venue <span class="text-xl">➜</span>
        </a>
    </section>

    {{-- Search Input --}}
    <section class="py-8 text-center mb-10">
        <form action="#" method="GET" class="max-w-xl mx-auto">
            <input type="text" name="search" placeholder="Search City or Country"
                class="w-full border rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring focus:border-blue-500">
        </form>
    </section>

    {{-- Card Venue --}}
    <section class="mb-10 flex">
        <div class="max-w-7xl mx-auto gap-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
            <x-venue-card image="images/stadioncitarum.jpg" title="Stadion Citarum" location="Kota Semarang"
                category="Futsal" price="Rp1.500.000" />

            <x-venue-card image="images/thearena.jpeg" title="The Arena" location="Kota Semarang" category="Futsal"
                price="Rp300.000" />

            <x-venue-card image="images/golden.png" title="Golder" location="Kota Semarang" category="Badminton"
                price="Rp25.000" />
        </div>
    </section>
</div>

@endsection