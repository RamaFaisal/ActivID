@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10">
    <h2 class="text-xl font-semibold mb-6">› Riwayat Pemesanan</h2>

    <!-- Filter Status -->
    <div class="bg-white rounded-lg shadow mb-6 p-4 flex flex-wrap gap-3 text-sm">
        <button class="px-4 py-2 rounded bg-blue-500 text-white">Semua Status</button>
        <button class="px-4 py-2 rounded text-gray-600 hover:bg-gray-100">Menunggu Pembayaran</button>
        <button class="px-4 py-2 rounded text-gray-600 hover:bg-gray-100">Menunggu Pelunasan</button>
        <button class="px-4 py-2 rounded text-gray-600 hover:bg-gray-100">Berhasil</button>
        <button class="px-4 py-2 rounded text-gray-600 hover:bg-gray-100">Dibatalkan</button>
        <button class="px-4 py-2 rounded text-gray-600 hover:bg-gray-100">Selesai</button>
    </div>

    <!-- List Riwayat -->
    <div class="space-y-4">
        <!-- Card 1 -->
        <div class="bg-white rounded shadow p-4 flex justify-between items-center">
            <div>
                <p class="text-sm font-semibold text-gray-800">09.00 – 10.00</p>
                <p class="text-sm text-gray-700">Stadium Citarum</p>
                <p class="text-sm text-gray-500">Lapangan Utama • Jum, 1 Agustus 2025</p>
            </div>
            <span class="text-blue-600 font-semibold text-sm">Selesai</span>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded shadow p-4 flex justify-between items-center border-l-4 border-pink-200">
            <div>
                <p class="text-sm font-semibold text-gray-800">08.00 – 09.00</p>
                <p class="text-sm text-gray-700">Stadium Citarum</p>
                <p class="text-sm text-gray-500">Lapangan Utama • Jum, 1 Agustus 2025</p>
            </div>
            <span class="text-blue-600 font-semibold text-sm">Selesai</span>
        </div>
    </div>
</div>
@endsection
