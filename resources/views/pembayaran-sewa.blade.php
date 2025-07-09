@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-2 gap-8">

    <!-- Kolom Kiri: Rincian Pemesanan -->
    <div class="bg-white p-6 rounded shadow space-y-4">
        <h2 class="text-xl font-semibold">Pembayaran</h2>
        <p class="text-sm text-gray-600">Stadium Citarum<br><span class="text-gray-400">📍 Kota Semarang, Jawa Tengah</span></p>

        <!-- Lapangan Utama -->
        <div>
            <p class="font-semibold mb-2">› Lapangan Utama</p>

            <!-- Slot Waktu -->
            <div class="bg-gray-100 rounded px-4 py-2 flex justify-between items-center mb-2">
                <div>
                    <p class="text-sm">Jum, 1 Agustus 2025 • 08.00 – 09.00</p>
                    <p class="text-sm text-gray-600">Rp 1.500.000</p>
                </div>
                <button class="text-gray-500 hover:text-red-600">🗑️</button>
            </div>
            <div class="bg-gray-100 rounded px-4 py-2 flex justify-between items-center">
                <div>
                    <p class="text-sm">Jum, 1 Agustus 2025 • 09.00 – 10.00</p>
                    <p class="text-sm text-gray-600">Rp 1.500.000</p>
                </div>
                <button class="text-gray-500 hover:text-red-600">🗑️</button>
            </div>
        </div>

        <!-- Rincian Biaya -->
        <div class="pt-4 border-t">
            <p class="font-semibold mb-2">› Rincian Biaya</p>
            <ul class="text-sm space-y-1">
                <li class="flex justify-between"><span>• Biaya Sewa</span> <span>Rp 3.000.000</span></li>
                <li class="flex justify-between"><span>• Biaya Aplikasi</span> <span>Rp 5.000</span></li>
            </ul>
            <p class="font-semibold mt-2 flex justify-between">Total Bayar <span class="text-orange-600">Rp 3.005.000</span></p>
        </div>
    </div>

    <!-- Kolom Kanan: Metode Pembayaran -->
    <div class="bg-white p-6 rounded shadow space-y-4">
        <h2 class="font-semibold mb-2">› Metode Pembayaran</h2>

        <form class="space-y-2">
            <label class="flex items-center justify-between bg-gray-100 p-3 mb-3 rounded cursor-pointer shadow-md">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/payments/gopay.png') }}" alt="gopay" class="w-6 h-6"> GoPay
                </div>
                <input type="radio" name="payment_method" value="gopay" checked>
            </label>

            <label class="flex items-center justify-between bg-gray-100 p-3 mb-3 rounded cursor-pointer shadow-md">
                <div class="flex items-center gap-6">
                    <img src="{{ asset('images/payments/ovo.png') }}" alt="ovo" width="60">
                    <p>OVO</p>
                </div>
                <input type="radio" name="payment_method" value="ovo">
            </label>

            <label class="flex items-center justify-between bg-gray-100 p-3 mb-3 rounded cursor-pointer shadow-md">
                <div class="flex items-center gap-6">
                    <img src="{{ asset('images/payments/dana.png') }}" alt="dana" width="60" class="">
                    <p>Dana</p>
                </div>
                <input type="radio" name="payment_method" value="dana">
            </label>

            <!-- Tambahkan metode lain sesuai kebutuhan -->

            <div class="pt-4">
                <button type="submit"
                    class="bg-orange-500 w-full text-white font-semibold py-3 rounded hover:bg-orange-600 transition">
                    Lakukan Pembayaran →
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
