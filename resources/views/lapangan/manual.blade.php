@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Tambah Booking Manual</h2>

    <form method="POST" action="{{ route('manual.store') }}" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-3">
            <label class="block font-semibold">Pilih Lapangan</label>
            <select name="id_lapangan" required class="w-full border rounded px-3 py-2">
                @foreach($lapangans as $lapangan)
                    <option value="{{ $lapangan->id }}">{{ $lapangan->nama_lapangan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Tanggal</label>
            <input type="date" name="tanggal" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Jam Mulai</label>
            <input type="time" name="jam_mulai" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Jam Selesai</label>
            <input type="time" name="jam_selesai" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Harga Total</label>
            <input type="number" name="harga" required class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Simpan Booking Manual
        </button>
    </form>
</div>
@endsection
