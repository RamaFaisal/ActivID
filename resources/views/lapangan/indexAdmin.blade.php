@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Daftar Lapangan Saya</h2>

    <a href="{{ route('lapangan-admin.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 inline-block mb-4">
        + Tambah Lapangan
    </a>

    @if($lapangans->isEmpty())
        <p class="text-gray-500">Belum ada lapangan yang ditambahkan.</p>
    @else
    <table class="w-full bg-white rounded shadow text-sm">
        <thead class="bg-green-100">
            <tr>
                <th class="p-2 text-left">Nama</th>
                <th class="p-2 text-left">Jenis</th>
                <th class="p-2 text-left">Jam Operasional</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lapangans as $lapangan)
            <tr class="border-t">
                <td class="p-2">{{ $lapangan->nama_lapangan }}</td>
                <td class="p-2">{{ $lapangan->jenis_lapangan }}</td>
                <td class="p-2">{{ $lapangan->jam_operasional_mulai }} - {{ $lapangan->jam_operasional_selesai }}</td>
                <td class="p-2">
                    @if($lapangan->is_active)
                        <span class="text-green-600 font-medium">Aktif</span>
                    @else
                        <span class="text-gray-500">Nonaktif</span>
                    @endif
                </td>
                <td class="p-2 text-center space-x-2">
                    <a href="{{ route('lapangan-admin.edit', $lapangan->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('lapangan-admin.destroy', $lapangan->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus lapangan ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
