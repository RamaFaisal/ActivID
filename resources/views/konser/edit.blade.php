@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Edit Konser</h2>

    <form action="{{ route('konser-admin.update', $konser->id_konser) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Nama Konser</label>
            <input type="text" name="nama_konser" class="w-full border p-2 rounded" value="{{ old('nama_konser', $konser->nama_konser) }}" required>
        </div>

        <div>
            <label class="block font-semibold">Artis</label>
            <input type="text" name="artis_konser" class="w-full border p-2 rounded" value="{{ old('artis_konser', $konser->artis_konser) }}" required>
        </div>

        <div class="flex space-x-2">
            <div class="w-1/2">
                <label class="block font-semibold">Tanggal</label>
                <input type="date" name="tanggal_konser" class="w-full border p-2 rounded" value="{{ old('tanggal_konser', $konser->tanggal_konser) }}" required>
            </div>
            <div class="w-1/2">
                <label class="block font-semibold">Jam</label>
                <input type="time" name="jam_konser" class="w-full border p-2 rounded" value="{{ old('jam_konser', $konser->jam_konser) }}" required>
            </div>
        </div>

        <div>
            <label class="block font-semibold">Lokasi</label>
            <input type="text" name="lokasi_konser" class="w-full border p-2 rounded" value="{{ old('lokasi_konser', $konser->lokasi_konser) }}" required>
        </div>

        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi_konser" class="w-full border p-2 rounded" rows="4">{{ old('deskripsi_konser', $konser->deskripsi_konser) }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">Proposal Saat Ini</label>
            @if($konser->file_proposal)
                <a href="{{ asset('storage/' . $konser->file_proposal) }}" class="text-blue-600 underline" target="_blank">Lihat Proposal</a>
            @else
                <p class="text-sm text-gray-500">Belum ada file</p>
            @endif
            <input type="file" name="file_proposal" accept="application/pdf" class="w-full border p-2 mt-2 rounded">
        </div>

        <div>
            <label class="block font-semibold">Banner Saat Ini</label>
            @if($konser->banner_konser)
                <img src="{{ asset('storage/' . $konser->banner_konser) }}" class="w-40 rounded shadow my-2">
            @else
                <p class="text-sm text-gray-500">Belum ada gambar</p>
            @endif
            <input type="file" name="banner_konser" accept="image/*" class="w-full border p-2 mt-2 rounded">
        </div>

        <div class="text-right">
            <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
