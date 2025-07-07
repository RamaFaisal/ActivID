<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white border rounded shadow">
        <h2 class="text-xl font-bold mb-4">Tambah Sesi Sewa</h2>
    
        @if(session('success'))
            <div class="text-green-600 mb-4">
                {{ session('success') }}
            </div>
        @endif
    
        <form method="POST" action="{{ route('sesi.store') }}">
            @csrf
    
            <div class="mb-4">
                <label for="lapangan_id" class="block font-semibold text-sm">Lapangan</label>
                <select name="lapangan_id" id="lapangan_id" class="w-full border p-2 rounded" required>
                    @foreach ($lapangans as $lapangan)
                        <option value="{{ $lapangan->id }}">{{ $lapangan->nama_lapangan }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="mb-4">
                <label for="tanggal_sesi" class="block font-semibold text-sm">Tanggal Sesi</label>
                <input type="date" name="tanggal_sesi" class="w-full border p-2 rounded" required>
            </div>
    
            <div class="mb-4">
                <label class="block font-semibold text-sm">Jam Sesi</label>
                <div class="flex gap-2">
                    <input type="time" name="jam_mulai_sesi" class="w-full border p-2 rounded" required>
                    <input type="time" name="jam_selesai_sesi" class="w-full border p-2 rounded" required>
                </div>
            </div>
    
            <div class="mb-4">
                <label for="harga_per_sesi" class="block font-semibold text-sm">Harga per Sesi</label>
                <input type="number" name="harga_per_sesi" class="w-full border p-2 rounded" required>
            </div>
    
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Simpan Sesi
            </button>
        </form>
    </div>
</body>
</html>