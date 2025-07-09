@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Edit Tiket</h2>

    <form action="{{ route('admin-tiket.update', $tiketEdit->id_jenis_tiket) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="font-semibold">Nama Tiket</label>
            <input type="text" name="nama_jenis_tiket" class="w-full border p-2 rounded" value="{{ old('nama_jenis_tiket', $tiketEdit->nama_jenis_tiket) }}" required>
        </div>

        <div>
            <label class="font-semibold">Harga Tiket</label>
            <input type="number" name="harga_tiket" class="w-full border p-2 rounded" value="{{ old('harga_tiket', $tiketEdit->harga_tiket) }}" required>
        </div>

        <div>
            <label class="font-semibold">Kuota Tiket</label>
            <input type="number" name="kuota_jenis_tiket" class="w-full border p-2 rounded" value="{{ old('kuota_jenis_tiket', $tiketEdit->kuota_jenis_tiket) }}" required>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
