@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Verifikasi Pengajuan Konser</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full bg-white shadow border rounded text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Nama Konser</th>
                <th class="p-2">Artis</th>
                <th class="p-2">Tanggal</th>
                <th class="p-2">Lokasi</th>
                <th class="p-2">Admin</th>
                <th class="p-2">Proposal</th>
                <th class="p-2">Status</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($konser as $k)
            <tr class="border-t">
                <td class="p-2 font-semibold">{{ $k->nama_konser }}</td>
                <td class="p-2">{{ $k->artis_konser }}</td>
                <td class="p-2">{{ $k->tanggal_konser }}</td>
                <td class="p-2">{{ $k->lokasi_konser }}</td>
                <td class="p-2">{{ $k->user->name ?? '-' }}</td>
                <td class="p-2">
                    @if($k->file_proposal)
                        <a href="{{ asset('storage/' . $k->file_proposal) }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                    @else
                        <span class="text-gray-500 italic">Tidak ada</span>
                    @endif
                </td>
                <td class="p-2 capitalize">{{ $k->status_konser }}</td>
                <td class="p-2 space-x-1">
                    @if($k->status_konser === 'menunggu')
                    <form action="{{ route('superadmin.konser.approve', $k->id_konser) }}" method="POST" class="inline">
                        @csrf
                        <button class="bg-green-600 text-white px-3 py-1 rounded text-xs">Setujui</button>
                    </form>
                    <form action="{{ route('superadmin.konser.reject', $k->id_konser) }}" method="POST" class="inline">
                        @csrf
                        <button class="bg-red-600 text-white px-3 py-1 rounded text-xs">Tolak</button>
                    </form>
                    @else
                    <span class="text-gray-500 text-xs">Selesai</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
