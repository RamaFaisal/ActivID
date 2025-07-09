@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Ringkasan Saldo Konser</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white border p-4 rounded shadow">
            <p class="text-gray-500 text-sm">Tiket Terjual</p>
            <p class="text-xl font-semibold">{{ $jumlahTiketTerjual }}</p>
        </div>
        <div class="bg-white border p-4 rounded shadow">
            <p class="text-gray-500 text-sm">Total Pendapatan</p>
            <p class="text-xl font-semibold text-green-700">Rp{{ number_format($totalPendapatan) }}</p>
        </div>
        <div class="bg-white border p-4 rounded shadow">
            <p class="text-gray-500 text-sm">Fee Platform (10%)</p>
            <p class="text-xl font-semibold text-red-600">Rp{{ number_format($potongan) }}</p>
        </div>
        <div class="bg-white border p-4 rounded shadow">
            <p class="text-gray-500 text-sm">Saldo Diterima</p>
            <p class="text-xl font-semibold text-blue-700">Rp{{ number_format($bersih) }}</p>
        </div>
    </div>
</div>
@endsection
