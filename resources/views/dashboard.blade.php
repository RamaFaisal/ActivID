@extends('layouts.admin')

@section('content')
    {{-- Slot untuk header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    {{-- Isi konten --}}
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <p class="mb-2">Selamat datang, <strong>{{ Auth::user()->name }}</strong></p>
    <p class="text-sm text-gray-600">Email: {{ Auth::user()->email }}</p>

    @if (Auth::user()->hasRole('superadmin'))
    {{-- Superadmin Section --}}
    <div class="mt-6 p-4 border border-blue-300 rounded bg-blue-50">
        <h2 class="font-semibold text-blue-700">Panel Superadmin</h2>
        <ul class="list-disc ml-5 text-sm mt-2">
            <li><a href="{{ route('pengajuan.index')}}" class="text-blue-500 hover:underline">Kelola Pengajuan Admin Lapangan</a></li>
            <li><a href="{{ route('superadmin.index')}}" class="text-blue-500 hover:underline">Kelola User & Role</a></li>
            <li><a href="{{ route('superadmin.saldo')}}" class="text-blue-500 hover:underline">Saldo</a></li>
        </ul>
    </div>

    @elseif (Auth::user()->hasRole('admin_lapangan'))
    {{-- Admin Lapangan Section --}}
    <div class="mt-6 p-4 border border-green-300 rounded bg-green-50">
        <h2 class="font-semibold text-green-700">Panel Admin Lapangan</h2>
        <ul class="list-disc ml-5 text-sm mt-2">
            <li><a href="{{ route('lapangan-admin.create')}}" class="text-green-600 hover:underline">Tambah Lapangan</a></li>
            <li><a href="{{ route('sesi.index')}}" class="text-green-600 hover:underline">Kelola Jadwal & Sesi</a></li>
            <li><a href="{{ route('manual.create')}}" class="text-green-600 hover:underline">Tambah Manual Booking</a></li>
            <li><a href="{{ route('admin.bookings')}}" class="text-green-600 hover:underline">Approve Booking</a></li>
            <li><a href="{{ route('scan.view')}}" class="text-green-600 hover:underline">Scan Booking</a></a></li>
            <li><a href="{{ route('admin.dompet')}}" class="text-green-600 hover:underline">Saldo</a></li>
        </ul>
    </div>

    @elseif (Auth::user()->hasRole('admin_konser'))
    {{-- Admin Konser Section --}}
    <div class="mt-6 p-4 border border-yellow-300 rounded bg-yellow-50">
        <h2 class="font-semibold text-yellow-700">Panel Admin Konser</h2>
        <ul class="list-disc ml-5 text-sm mt-2">
            <li><a href="#" class="text-yellow-600 hover:underline">Tambah Konser</a></li>
            <li><a href="#" class="text-yellow-600 hover:underline">Kelola Tiket</a></li>
        </ul>
    </div>

    @elseif (Auth::user()->hasRole('user'))
    {{-- User Biasa Section --}}
    <div class="mt-6 p-4 border border-red-300 rounded bg-red-50">
        <h2 class="font-semibold text-red-700">Panel User Biasa</h2>
        <ul class="list-disc ml-5 text-sm mt-2">
            <li><a href="{{ route('booking.saya') }}" class="text-red-600 hover:underline">Pesan Lapangan</a></li>
            <li><a href="#" class="text-red-600 hover:underline">Pesan Konser</a></li>
        </ul>
    </div>
    @endif
</div>
@endsection