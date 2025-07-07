<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ActivID: Detail Lapangan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<body class="bg-gray-100 font-sans antialiased p-6">
    @if (session('success'))
        <div class="max-w-3xl mx-auto mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-3xl mx-auto mb-4 p-4 bg-red-100 border border-red-400 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Detail Lapangan --}}
    <div class="max-w-3xl mx-auto bg-white border rounded shadow p-6">
        <img src="{{ asset('storage/' . $lapangan->gambar) }}" alt="Gambar Lapangan">
        <h2 class="text-2xl font-bold text-gray-800">{{ $lapangan->nama_lapangan }}</h2>
        <p class="text-gray-600">{{ $lapangan->jenis_lapangan }}</p>
        <p class="mt-4 text-gray-700">{{ $lapangan->deskripsi_lapangan }}</p>
        <p class="mt-4 text-sm text-gray-700"><strong>Alamat:</strong> {{ $lapangan->alamat }}</p>
        <p class="text-sm text-gray-700">
            <strong>Jam buka:</strong> {{ $lapangan->jam_operasional_mulai }} - {{ $lapangan->jam_operasional_selesai }}
        </p>
    </div>

    {{-- Jadwal Sesi --}}
    <div class="max-w-3xl mx-auto mt-6 p-6 border rounded bg-gray-50">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Jadwal Sesi Tersedia</h3>

        @if($lapangan->sesiSewa->isEmpty())
            <p class="text-sm text-gray-500">Belum ada sesi tersedia.</p>
        @else
            <ul class="space-y-3">
                @foreach($lapangan->sesiSewa as $sesi)
                    <li class="mb-2 border p-2 rounded bg-white shadow-sm text-sm">
                        <strong>{{ $sesi->tanggal_sesi }}</strong> | 
                        {{ $sesi->jam_mulai_sesi }} - {{ $sesi->jam_selesai_sesi }} |
                        Rp{{ number_format($sesi->harga_per_sesi) }}

                        @if($sesi->is_booked)
                            <span class="ml-2 text-red-600">Terbooking</span>
                        @elseif(!$sesi->is_available)
                            <span class="ml-2 text-yellow-600">Tidak Tersedia</span>
                        @else
                            <a href="{{ route('sewa.checkout', $sesi->id) }}"
                            class="ml-2 text-green-600 underline">Booking</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</body>
</html>