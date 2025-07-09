@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Form Pengajuan Admin Konser</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pengajuan.konser.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Nama Lengkap</label>
            <input type="text" name="nama_pengaju" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold">Email Aktif</label>
            <input type="email" name="email_pengaju" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold">Nomor WhatsApp / HP</label>
            <input type="text" name="nomor_pengaju" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold">Domisili</label>
            <input type="text" name="domisili" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold">Upload Foto KTP</label>
            <input type="file" name="foto_ktp" required class="w-full">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Kirim Pengajuan
        </button>
    </form>
</div>
@endsection