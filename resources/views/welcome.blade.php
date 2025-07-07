@extends('layouts.app')

@section('title', 'ActivID – Landing Page')

@section('content')

    {{-- Hero Section --}}
    <x-hero />

    {{-- Fitur --}}
    <x-feature-section />

    {{-- Event Fav --}}
    <section class="py-16 bg-orange-400 text-center">
        <h2 class="text-2xl font-bold mb-10">Event Favorit</h2>

        <div class="flex flex-col md:flex-row items-center justify-center gap-6 px-4">
            <x-event-card 
                image="images/pestapora.png" 
                title="Pestapora" 
                date="15 Juni 2025" 
                location="Solo"
                link="/konser/pestapora" />

            <x-event-card 
                image="images/synchronize.png" 
                title="Synchronize Fest" 
                date="3–5 Oktober 2025"
                location="Jakarta" 
                link="/konser/synchronize" />

            <x-event-card 
                image="images/javajazz.png" 
                title="Java Jazz Fest" 
                date="30 Mei – 1 Juni 2025"
                location="Jakarta" 
                link="/konser/javajazz" />
        </div>
    </section>

    {{-- Venue Fav --}}
    <section class="py-16 bg-gray-50 text-center">
        <h2 class="text-2xl font-bold mb-10">Venue Favorit</h2>

        <div class="flex flex-col md:flex-row justify-center items-center gap-6 px-4">
            <x-venue-card 
                image="images/stadioncitarum.jpg" 
                title="Stadion Citarum" 
                location="Kota Semarang"
                category="Tenis" 
                price="Rp1.500.000" />

            <x-venue-card 
                image="images/thearena.jpeg" 
                title="The Arena" 
                location="Kota Semarang" 
                category="Tenis"
                price="Rp300.000" />

            <x-venue-card 
                image="images/golden.png" 
                title="Golden" 
                location="Kota Semarang" 
                category="Tenis"
                price="Rp35.000" />
        </div>
    </section>

    {{-- CTA Join --}}
    <section class="py-20 bg-blue-700 text-white text-center px-6">
        <h2 class="text-3xl md:text-4xl font-bold leading-tight mb-4">
            Siap Booking Lapangan atau Nonton Konser?
        </h2>
        <p class="text-lg mb-8 text-white/90">
            Gabung sekarang dan nikmati semua kemudahan reservasi dalam satu platform
        </p>
        <a href="/register"
            class="inline-block bg-white text-blue-700 font-semibold px-6 py-3 rounded shadow hover:bg-gray-100 transition">
            Daftar Sekarang
        </a>
    </section>

@endsection
