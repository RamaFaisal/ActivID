@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Dashboard Developer</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-6 rounded shadow">
            <p class="text-lg font-semibold">Total Fee Developer</p>
            <h1 class="text-3xl font-bold text-blue-600 mt-2">
                Rp{{ number_format($totalFee, 0, ',', '.') }}
            </h1>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <p class="text-lg font-semibold">Jumlah Transaksi Sukses</p>
            <h1 class="text-3xl font-bold text-green-600 mt-2">{{ $totalTransaksi }}</h1>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-3">Riwayat Transaksi</h3>

        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-3">#</th>
                    <th class="py-2 px-3">User</th>
                    <th class="py-2 px-3">Lapangan</th>
                    <th class="py-2 px-3">Tanggal</th>
                    <th class="py-2 px-3">Total</th>
                    <th class="py-2 px-3">Fee Developer (10%)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-3">{{ $booking->id_sewa }}</td>
                        <td class="py-2 px-3">{{ $booking->user->name }}</td>
                        <td class="py-2 px-3">{{ $booking->lapangan->nama_lapangan }}</td>
                        <td class="py-2 px-3">{{ $booking->tanggal_sewa }}</td>
                        <td class="py-2 px-3">Rp{{ number_format($booking->total_harga_sewa) }}</td>
                        <td class="py-2 px-3 text-blue-600">Rp{{ number_format($booking->fee_platform) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-3 text-center text-gray-500">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
