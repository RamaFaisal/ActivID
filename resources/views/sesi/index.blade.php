<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h2 class="text-xl font-bold mb-4">Daftar Sesi Sewa Lapangan</h2>
    <a href="{{ route('sesi.create') }}" class="text-sm text-green-600 underline">+ Tambah Sesi Baru</a>
    @foreach ($lapangans as $lapangan)
        <div class="mb-6 border p-4 rounded shadow">
            <h3 class="text-lg font-semibold">{{ $lapangan->nama_lapangan }}</h3>

            @if ($lapangan->sesiSewa->isEmpty())
                <p class="text-sm text-gray-500 mt-2">Belum ada sesi.</p>
            @else
                <ul class="list-disc ml-6 mt-2 text-sm">
                    @foreach ($lapangan->sesiSewa as $sesi)
                        <li>
                            {{ $sesi->tanggal_sesi }} |
                            {{ $sesi->jam_mulai_sesi }} - {{ $sesi->jam_selesai_sesi }} |
                            Rp{{ number_format($sesi->harga_per_sesi) }} |
                            {{ $sesi->is_available ? 'Tersedia' : 'Tidak Tersedia' }} |
                            @if ($sesi->is_booked && $sesi->sewa && $sesi->sewa->user)
                                Sudah Dipesan oleh {{ $sesi->sewa->user->name }}
                            @else
                                Belum Dipesan
                            @endif
                        </li>
                        <form action="{{ route('sesi.destroy', $sesi->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('sesi.edit', $sesi->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                            <button type="submit" class="text-red-600 hover:underline"
                                onclick="return confirm('Yakin ingin menghapus sesi ini?')">Hapus</button>
                        </form>
                    @endforeach
                </ul>
            @endif
        </div>
    @endforeach
</body>
</html>