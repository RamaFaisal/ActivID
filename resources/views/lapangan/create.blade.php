@extends('layouts.admin')

@section('content')
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white border rounded shadow">
        <h2 class="text-xl font-bold mb-4">Tambah Lapangan Baru</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-500 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('lapangan-admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold text-sm mb-1" for="nama_lapangan">Nama Lapangan</label>
                <input type="text" name="nama_lapangan" id="nama_lapangan" class="w-full border p-2 rounded" value="{{ old('nama_lapangan') }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-sm mb-1" for="jenis_lapangan">Jenis Lapangan</label>
                <input type="text" name="jenis_lapangan" id="jenis_lapangan" class="w-full border p-2 rounded" value="{{ old('jenis_lapangan') }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-sm mb-1" for="alamat_lapangan">Alamat</label>
                <textarea name="alamat" id="alamat" class="w-full border p-2 rounded" required>{{ old('alamat') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-sm mb-1" for="deskripsi_lapangan">Deskripsi</label>
                <textarea name="deskripsi_lapangan" id="deskripsi_lapangan" class="w-full border p-2 rounded">{{ old('deskripsi_lapangan') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-sm mb-1">Jam Operasional</label>
                <div class="flex gap-4">
                    <div>
                        <label class="text-sm">Mulai</label>
                        <input type="time" name="jam_operasional_mulai" class="border p-2 rounded" value="{{ old('jam_operasional_mulai') }}" required>
                    </div>
                    <div>
                        <label class="text-sm">Selesai</label>
                        <input type="time" name="jam_operasional_selesai" class="border p-2 rounded" value="{{ old('jam_operasional_selesai') }}" required>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-sm mb-1">Upload Gambar</label>
                <input type="file" name="gambar" accept="image/*" class="w-full mb-3 p-2 border rounded">
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Simpan Lapangan
            </button>
        </form>
    </div>
@endsection