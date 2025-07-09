@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Kelola Jadwal & Sesi</h2>

    @foreach($lapangans as $lapangan)
    <div class="mb-6 bg-white border rounded shadow p-4">
        <h3 class="text-xl font-semibold text-green-700">{{ $lapangan->nama_lapangan }}</h3>
        <a href="{{ route('sesi.create', ['lapangan_id' => $lapangan->id]) }}" class="text-blue-600 text-sm underline">+ Tambah Sesi</a>

        @if($lapangan->sesiSewa->isEmpty())
            <p class="text-gray-500 mt-2">Belum ada sesi tersedia.</p>
        @else
        <table class="w-full mt-4 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">Jam</th>
                    <th class="p-2">Harga</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lapangan->sesiSewa as $sesi)
                <tr class="border-t">
                    <td class="p-2">{{ $sesi->tanggal_sesi }}</td>
                    <td class="p-2">{{ $sesi->jam_mulai_sesi }} - {{ $sesi->jam_selesai_sesi }}</td>
                    <td class="p-2">Rp{{ number_format($sesi->harga_per_sesi) }}</td>
                    <td class="p-2">
                        @if($sesi->is_booked)
                            <span class="text-red-600">Terbooking</span>
                        @elseif(!$sesi->is_available)
                            <span class="text-gray-600">Tidak Tersedia</span>
                        @else
                            <span class="text-green-600">Tersedia</span>
                        @endif
                    </td>
                    <td class="p-2 space-x-2">
                        <a href="{{ route('sesi.edit', $sesi->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('sesi.destroy', $sesi->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus sesi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    @endforeach
</div>
@endsection