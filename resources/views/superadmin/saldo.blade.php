@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Dashboard Developer</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow border">
            <p class="text-lg font-semibold text-gray-700">Total Fee Developer (Lapangan + Konser)</p>
            <h1 class="text-3xl font-bold text-blue-600 mt-2">
                Rp{{ number_format($totalFee, 0, ',', '.') }}
            </h1>
        </div>
        {{-- <div class="bg-white p-6 rounded-xl shadow border">
            <p class="text-lg font-semibold text-gray-700">Jumlah Transaksi Sukses</p>
            <h1 class="text-3xl font-bold text-green-600 mt-2">{{ $totalTransaksi }}</h1>
        </div> --}}
    </div>

    <div class="bg-white p-6 rounded-xl shadow border mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Fee Developer</h3>
        <div class="grid md:grid-cols-2 gap-4 text-sm">
            <p><span class="font-semibold">Fee dari Lapangan:</span> Rp{{ number_format($totalFeeLapangan) }}</p>
            <p><span class="font-semibold">Fee dari Konser:</span> Rp{{ number_format($feeKonser) }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow border">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Transaksi Lapangan</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border text-left">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-4 border-b">ID</th>
                        <th class="py-3 px-4 border-b">Lapangan</th>
                        <th class="py-3 px-4 border-b">Tanggal</th>
                        <th class="py-3 px-4 border-b">Total</th>
                        <th class="py-3 px-4 border-b">Fee Developer</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $booking->id_sewa }}</td>
                            <td class="py-3 px-4">{{ $booking->lapangan->nama_lapangan }}</td>
                            <td class="py-3 px-4">{{ $booking->tanggal_sewa }}</td>
                            <td class="py-3 px-4">Rp{{ number_format($booking->total_harga_sewa) }}</td>
                            <td class="py-3 px-4 text-blue-600">Rp{{ number_format($booking->fee_platform) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-6">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
