@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <div class="bg-white p-6 rounded shadow text-center">
        <h2 class="text-2xl font-bold text-gray-800">Selamat datang, {{ Auth::user()->name }}</h2>
        <p class="text-sm text-gray-500">Email: {{ Auth::user()->email }}</p>
    </div>

    {{-- SUPERADMIN --}}
    @if (Auth::user()->hasRole('superadmin'))
    <div class="mt-8">
        <h3 class="text-xl font-semibold text-blue-700 mb-4">Panel Superadmin</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ([
                ['route' => 'pengajuan.index', 'label' => 'Kelola Pengajuan Admin Lapangan'],
                ['route' => 'pengajuanKonser.index', 'label' => 'Kelola Pengajuan Admin Konser'],
                ['route' => 'superadmin.konser.index', 'label' => 'Pengajuan Konser'],
                ['route' => 'superadmin.index', 'label' => 'Kelola User & Role'],
                ['route' => 'superadmin.saldo', 'label' => 'Saldo'],
            ] as $item)
            <a href="{{ route($item['route']) }}"
                class="block p-4 rounded-lg bg-blue-50 border border-blue-200 hover:bg-blue-100 transition text-blue-700 shadow-sm">
                {{ $item['label'] }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- ADMIN LAPANGAN --}}
    @elseif (Auth::user()->hasRole('admin_lapangan'))
    <div class="mt-8">
        <h3 class="text-xl font-semibold text-green-700 mb-4">Panel Admin Lapangan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ([
                ['route' => 'lapangan-admin.index', 'label' => 'Lapangan'],
                ['route' => 'sesi.index', 'label' => 'Jadwal & Sesi'],
                ['route' => 'manual.create', 'label' => 'Tambah Manual Booking'],
                ['route' => 'admin.bookings', 'label' => 'Approve Booking'],
                ['route' => 'scan.view', 'label' => 'Scan Booking'],
                ['route' => 'admin.dompet', 'label' => 'Saldo'],
            ] as $item)
            <a href="{{ route($item['route']) }}"
                class="block p-4 rounded-lg bg-green-50 border border-green-200 hover:bg-green-100 transition text-green-700 shadow-sm">
                {{ $item['label'] }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- ADMIN KONSER --}}
    @elseif (Auth::user()->hasRole('admin_konser'))
    <div class="mt-8">
        <h3 class="text-xl font-semibold text-yellow-700 mb-4">Panel Admin Konser</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ([
                ['route' => 'konser-admin.index', 'label' => 'Kelola Konser'],
                ['route' => 'admin-tiket.index', 'label' => 'Kelola Tiket'],
                ['route' => 'admin.verifikasi.index', 'label' => 'Verifikasi Tiket'],
                ['route' => 'scan.index', 'label' => 'Scan QR Code'],
                ['route' => 'admin.saldo', 'label' => 'Saldo'],
            ] as $item)
            <a href="{{ route($item['route']) }}"
                class="block p-4 rounded-lg bg-yellow-50 border border-yellow-200 hover:bg-yellow-100 transition text-yellow-700 shadow-sm">
                {{ $item['label'] }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- USER --}}
    @elseif (Auth::user()->hasRole('user'))
    <div class="mt-8">
        <h3 class="text-xl font-semibold text-red-700 mb-4">Panel Pengguna</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('booking.saya') }}"
                class="block p-4 rounded-lg bg-red-50 border border-red-200 hover:bg-red-100 transition text-red-700 shadow-sm">
                Pesan Lapangan
            </a>
            <a href="{{ route('tiket.saya') }}"
                class="block p-4 rounded-lg bg-red-50 border border-red-200 hover:bg-red-100 transition text-red-700 shadow-sm">
                Pesan Tiket Konser
            </a>
        </div>
    </div>
    @endif
</div>
@endsection
