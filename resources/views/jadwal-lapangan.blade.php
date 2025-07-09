@extends('layouts.app')
@section('content')
<x-section-header title="Jadwal" />
<div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
    <!-- Kolom Kiri: Lapangan -->
    <div class="md:col-span-1">
        <h2 class="text-lg font-semibold mb-3">Pilih Lapangan</h2>
        <div class="rounded overflow-hidden border shadow">
            <img src="{{ asset('images/lapangan.jpg') }}" alt="Lapangan Utama" class="w-full object-cover">
            <p class="p-2 text-center font-semibold">Lapangan Utama</p>
        </div>
    </div>

    <!-- Kolom Kanan: Jadwal -->
    <div class="md:col-span-2 bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-center mb-6">Stadium Citarum</h2>

        <!-- Tanggal Pilihan -->
        <div class="flex gap-2 mb-4 overflow-x-auto">
            <button class="bg-blue-500 text-white px-4 py-2 rounded text-sm">Jum<br>1 Ags</button>
            <button class="bg-gray-100 px-4 py-2 rounded text-sm">Sab<br>2 Ags</button>
            <button class="bg-gray-100 px-4 py-2 rounded text-sm">Min<br>3 Ags</button>
            <button class="bg-gray-100 px-4 py-2 rounded text-sm">Sen<br>4 Ags</button>
            <button class="bg-gray-100 px-4 py-2 rounded text-sm">Sel<br>5 Ags</button>
            <button class="bg-gray-100 px-4 py-2 rounded text-sm">Rab<br>6 Ags</button>
        </div>

        <!-- Jadwal Jam -->
        <div class="grid grid-cols-3 md:grid-cols-4 gap-4">
            {{-- Sesi Tersedia --}}
            <div class="p-3 border rounded text-center hover:bg-blue-50 cursor-pointer">
                <p class="font-semibold text-blue-700">08.00 - 09.00</p>
                <p>Rp1.500.000</p>
            </div>
            <div class="p-3 border rounded text-center hover:bg-blue-50 cursor-pointer bg-blue-100 border-blue-500">
                <p class="font-semibold text-blue-700">09.00 - 10.00</p>
                <p>Rp1.500.000</p>
            </div>

            {{-- Sesi Booked --}}
            <div class="p-3 border rounded text-center bg-gray-200 text-gray-400 cursor-not-allowed">
                <p class="font-semibold">17.00 - 18.00</p>
                <p>Booked</p>
            </div>
            <div class="p-3 border rounded text-center bg-gray-200 text-gray-400 cursor-not-allowed">
                <p class="font-semibold">18.00 - 19.00</p>
                <p>Booked</p>
            </div>
            {{-- Tambahkan sesi lainnya sesuai kebutuhan --}}
        </div>

        <!-- Tombol Pembayaran -->
        <div class="mt-6 text-right">
            <a href="#" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600 transition">Pembayaran
                →</a>
        </div>
    </div>
</div>
@endsection