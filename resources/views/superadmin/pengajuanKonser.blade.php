@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Verifikasi Pengajuan Admin Konser</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <table class="w-full bg-white border rounded shadow text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Nama</th>
                <th class="p-2">Email</th>
                <th class="p-2">Nomor</th>
                <th class="p-2">Domisili</th>
                <th class="p-2">KTP</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengajuanKonser as $p)
            <tr class="border-t hover:bg-gray-50">
                <td class="p-2">{{ $p->nama_pengaju }}</td>
                <td class="p-2">{{ $p->email_pengaju }}</td>
                <td class="p-2">{{ $p->nomor_pengaju }}</td>
                <td class="p-2">{{ $p->domisili }}</td>
                <td class="p-2">
                    @if($p->foto_ktp)
                        <a href="{{ asset('storage/' . $p->foto_ktp) }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                    @else
                        <span class="text-gray-500 italic">Tidak ada</span>
                    @endif
                </td>
                <td class="p-2 flex gap-2">
                    <form action="{{ route('pengajuanKonser.approve', $p->id) }}" method="POST">
                        @csrf
                        <button class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700">
                            Setujui
                        </button>
                    </form>

                    <form action="{{ route('pengajuanKonser.reject', $p->id) }}" method="POST">
                        @csrf
                        <button class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700">
                            Tolak
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-gray-500 p-4">Tidak ada pengajuan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection