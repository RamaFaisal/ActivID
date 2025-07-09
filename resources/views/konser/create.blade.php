@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Ajukan Konser Baru</h2>

    <form action="{{ route('konser-admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Nama Konser</label>
            <input type="text" name="nama_konser" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Artis</label>
            <input type="text" name="artis_konser" class="w-full border p-2 rounded" required>
        </div>

        <div class="flex space-x-2">
            <div class="w-1/2">
                <label class="block font-semibold">Tanggal</label>
                <input type="date" name="tanggal_konser" class="w-full border p-2 rounded" required>
            </div>
            <div class="w-1/2">
                <label class="block font-semibold">Jam</label>
                <input type="time" name="jam_konser" class="w-full border p-2 rounded" required>
            </div>
        </div>

        <div>
            <label class="block font-semibold">Lokasi</label>
            <input type="text" name="lokasi_konser" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi_konser" class="w-full border p-2 rounded" rows="4"></textarea>
        </div>

        <div>
            <label class="block font-semibold">Upload Proposal (PDF)</label>
            <input type="file" name="file_proposal" accept="application/pdf" class="w-full border p-2 rounded">
            <p class="text-sm text-gray-500">Opsional. Max 2MB.</p>
        </div>

        <div>
            <label class="block font-semibold">Upload Banner Konser (Gambar)</label>
            <input type="file" name="banner_konser" accept="image/*" class="w-full border p-2 rounded">
            <p class="text-sm text-gray-500">Opsional. Max 2MB.</p>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                Simpan Konser
            </button>
        </div>
    </form>
</div>
@endsection
