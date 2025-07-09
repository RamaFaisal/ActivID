@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Tambah Tiket Konser</h2>

    <form action="{{ route('admin-tiket.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="font-semibold">Pilih Konser</label>
            <select name="id_konser" class="w-full border p-2 rounded" required>
                <option disabled selected>-- Pilih konser --</option>
                @foreach ($konsers as $konser)
                    <option value="{{ $konser->id_konser }}">{{ $konser->nama_konser }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-semibold">Nama Tiket</label>
            <input type="text" name="nama_jenis_tiket" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="font-semibold">Harga Tiket</label>
            <input type="number" name="harga_tiket" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="font-semibold">Kuota Tiket</label>
            <input type="number" name="kuota_jenis_tiket" class="w-full border p-2 rounded" required>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>
    </form>
</div>
@endsection
