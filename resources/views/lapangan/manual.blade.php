@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Tambah Booking Manual</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('manual.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block font-semibold mb-1">Pilih Sesi</label>
            <select name="sesi_id" required class="w-full border p-2 rounded">
                <option disabled selected>-- Pilih sesi tersedia --</option>
                @foreach($sesiTersedia as $sesi)
                    <option value="{{ $sesi->id }}">
                        {{ $sesi->lapangan->nama_lapangan }} |
                        {{ $sesi->tanggal_sesi }} {{ $sesi->jam_mulai_sesi }} - {{ $sesi->jam_selesai_sesi }} |
                        Rp{{ number_format($sesi->harga_per_sesi, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
            @error('sesi_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Nama Penyewa</label>
            <input type="text" name="nama_penyewa" class="w-full border p-2 rounded" required value="{{ old('nama_penyewa') }}">
            @error('nama_penyewa') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Catatan (opsional)</label>
            <textarea name="catatan" class="w-full border p-2 rounded">{{ old('catatan') }}</textarea>
            @error('catatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="text-right">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Simpan Booking
            </button>
        </div>
    </form>
</div>
@endsection
