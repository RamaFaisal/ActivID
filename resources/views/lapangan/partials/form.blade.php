<div>
  <label class="font-semibold">Nama Lapangan</label>
  <input type="text" name="nama_lapangan" class="w-full border p-2 rounded" value="{{ old('nama_lapangan', $lapangan->nama_lapangan ?? '') }}" required>
  @error('nama_lapangan') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div>
  <label class="font-semibold">Jenis Lapangan</label>
  <input type="text" name="jenis_lapangan" class="w-full border p-2 rounded" value="{{ old('jenis_lapangan', $lapangan->jenis_lapangan ?? '') }}" required>
  @error('jenis_lapangan') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div>
  <label class="font-semibold">Alamat</label>
  <textarea name="alamat" class="w-full border p-2 rounded" required>{{ old('alamat', $lapangan->alamat ?? '') }}</textarea>
  @error('alamat') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div>
  <label class="font-semibold">Deskripsi</label>
  <textarea name="deskripsi_lapangan" class="w-full border p-2 rounded">{{ old('deskripsi_lapangan', $lapangan->deskripsi_lapangan ?? '') }}</textarea>
</div>

<div class="flex space-x-4">
  <div class="w-1/2">
      <label class="font-semibold">Jam Buka</label>
      <input type="time" name="jam_operasional_mulai" class="w-full border p-2 rounded @error('jam_operasional_mulai') border-red-500 @enderror" value="{{ old('jam_operasional_mulai', $lapangan->jam_operasional_mulai ?? '') }}" required>
      @error('jam_operasional_mulai')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
  </div>
  <div class="w-1/2">
      <label class="font-semibold">Jam Tutup</label>
      <input type="time" name="jam_operasional_selesai" class="w-full border p-2 rounded @error('jam_operasional_selesai') border-red-500 @enderror" value="{{ old('jam_operasional_selesai', $lapangan->jam_operasional_selesai ?? '') }}" required>
      @error('jam_operasional_selesai')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
      @enderror
  </div>
</div>

<div>
  <label class="font-semibold">Gambar (opsional)</label>
  <input type="file" name="gambar" class="w-full border p-2 rounded">
  @if(!empty($lapangan->gambar))
      <p class="mt-2 text-sm text-gray-600">Gambar saat ini:</p>
      <img src="{{ asset('storage/' . $lapangan->gambar) }}" class="w-32 h-auto mt-1">
  @endif
</div>
