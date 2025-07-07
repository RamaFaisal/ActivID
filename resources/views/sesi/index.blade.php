@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Daftar Sesi Sewa Lapangan</h2>
        <a href="{{ route('sesi.create') }}"
           class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition text-sm">
            + Tambah Sesi Baru
        </a>
    </div>

    @foreach ($lapangans as $lapangan)
        <div class="mb-6 border border-gray-200 p-5 rounded-xl bg-white shadow-sm">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $lapangan->nama_lapangan }}</h3>

            @if ($lapangan->sesiSewa->isEmpty())
                <p class="text-sm text-gray-500">Belum ada sesi untuk lapangan ini.</p>
            @else
                <div class="space-y-3">
                    @foreach ($lapangan->sesiSewa as $sesi)
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 flex flex-col md:flex-row md:justify-between md:items-center gap-2">
                            <div class="text-sm text-gray-700">
                                <p><strong>Tanggal:</strong> {{ $sesi->tanggal_sesi }}</p>
                                <p><strong>Jam:</strong> {{ $sesi->jam_mulai_sesi }} - {{ $sesi->jam_selesai_sesi }}</p>
                                <p><strong>Harga:</strong> Rp{{ number_format($sesi->harga_per_sesi) }}</p>
                                <p><strong>Status:</strong> {{ $sesi->is_available ? 'Tersedia' : 'Tidak Tersedia' }}</p>
                                <p><strong>Booking:</strong>
                                    @if ($sesi->is_booked && $sesi->sewa && $sesi->sewa->user)
                                        Sudah Dipesan oleh <span class="font-medium">{{ $sesi->sewa->user->name }}</span>
                                    @else
                                        Belum Dipesan
                                    @endif
                                </p>
                            </div>
                            <div class="flex gap-2 mt-2 md:mt-0">
                                <a href="{{ route('sesi.edit', $sesi->id) }}"
                                   class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded text-sm">Edit</a>

                                <form action="{{ route('sesi.destroy', $sesi->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus sesi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
@endsection