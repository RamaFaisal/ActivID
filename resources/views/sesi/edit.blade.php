@extends('layouts.admin')

@section('content')
  <div class="max-w-xl mx-auto mt-10 p-6 bg-white border rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Sesi Sewa</h2>

    <form method="POST" action="{{ route('sesi.update', $sesi->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="lapangan_id" class="block font-semibold text-sm">Lapangan</label>
            <select name="lapangan_id" id="lapangan_id" class="w-full border p-2 rounded" required>
                @foreach ($lapangans as $lapangan)
                    <option value="{{ $lapangan->id }}" {{ $lapangan->id == $sesi->lapangan_id ? 'selected' : '' }}>
                        {{ $lapangan->nama_lapangan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-sm">Tanggal</label>
            <input type="date" name="tanggal_sesi" class="w-full border p-2 rounded"
                   value="{{ $sesi->tanggal_sesi }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-sm">Jam Mulai</label>
            <input type="time" name="jam_mulai_sesi" class="w-full border p-2 rounded"
                   value="{{ $sesi->jam_mulai_sesi }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-sm">Jam Selesai</label>
            <input type="time" name="jam_selesai_sesi" class="w-full border p-2 rounded"
                   value="{{ $sesi->jam_selesai_sesi }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold text-sm">Harga per Sesi</label>
            <input type="number" name="harga_per_sesi" class="w-full border p-2 rounded"
                   value="{{ $sesi->harga_per_sesi }}" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection