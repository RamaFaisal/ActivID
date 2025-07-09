@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Pesan Tiket: {{ $konser->nama_konser }}</h2>

    <form action="{{ route('pemesanan.tiket.store', $konser->slug) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="font-semibold">Jenis Tiket</label>
            <select name="id_jenis_tiket" class="w-full border p-2 rounded" required>
                @foreach($jenisTiket as $jenis)
                    <option value="{{ $jenis->id_jenis_tiket }}">
                        {{ $jenis->nama_jenis_tiket }} - Rp{{ number_format($jenis->harga_tiket) }} (Sisa: {{ $jenis->kuota_jenis_tiket }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Jumlah Tiket</label>
            <input type="number" name="jumlah_tiket_dibeli" class="w-full border p-2 rounded" min="1" required>
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Pesan Sekarang
        </button>
    </form>
</div>
@endsection
