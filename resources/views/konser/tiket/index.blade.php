@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Daftar Tiket Konser</h2>

    <a href="{{ route('admin-tiket.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 inline-block mb-4">
        + Tambah Tiket
    </a>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    @forelse ($konserSaya as $konser)
        <div class="mb-6 border rounded p-4 bg-white shadow">
            <h3 class="font-semibold text-lg mb-2">{{ $konser->nama_konser }}</h3>

            @if ($konser->tiketKonser->isEmpty())
                <p class="text-sm text-gray-500">Belum ada tiket.</p>
            @else
                <table class="w-full text-sm border bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border">Nama Tiket</th>
                            <th class="p-2 border">Harga</th>
                            <th class="p-2 border">Kuota</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($konser->tiketKonser as $tiket)
                            <tr class="border-t">
                                <td class="p-2 border">{{ $tiket->nama_jenis_tiket }}</td>
                                <td class="p-2 border">Rp{{ number_format($tiket->harga_tiket) }}</td>
                                <td class="p-2 border">{{ $tiket->kuota_jenis_tiket }}</td>
                                <td class="p-2 border">
                                    <a href="{{ route('admin-tiket.edit', $tiket->id_jenis_tiket) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin-tiket.destroy', $tiket->id_jenis_tiket) }}" method="POST" class="inline" onsubmit="return confirm('Hapus tiket ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @empty
        <p class="text-gray-500">Kamu belum memiliki konser.</p>
    @endforelse
</div>
@endsection
