@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Dompet Admin Lapangan</h2>

    <div class="bg-white rounded p-6 shadow mb-6">
        <p class="text-lg">Total Pendapatan Terkumpul:</p>
        <h1 class="text-3xl font-bold text-green-600 mt-1 mb-2">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h1>
        <p class="text-gray-600 text-sm">{{ $jumlahTransaksi }} transaksi disetujui</p>
    </div>

    <div class="bg-white rounded p-4 shadow">
        <h3 class="text-lg font-semibold mb-3">Riwayat Booking</h3>

        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-3">#</th>
                    <th class="py-2 px-3">User</th>
                    <th class="py-2 px-3">Tanggal</th>
                    <th class="py-2 px-3">Jam</th>
                    <th class="py-2 px-3">Total</th>
                    <th class="py-2 px-3">Diterima</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-3">{{ $booking->id_sewa }}</td>
                        <td class="py-2 px-3">{{ $booking->user->name }}</td>
                        <td class="py-2 px-3">{{ $booking->tanggal_sewa }}</td>
                        <td class="py-2 px-3">{{ $booking->jam_mulai_sewa }} - {{ $booking->jam_selesai_sewa }}</td>
                        <td class="py-2 px-3">Rp{{ number_format($booking->total_harga_sewa) }}</td>
                        <td class="py-2 px-3 text-green-600">Rp{{ number_format($booking->jumlah_diterima) }}</td>
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
