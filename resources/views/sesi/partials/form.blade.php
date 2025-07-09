<div>
  <label class="font-semibold">Pilih Lapangan</label>
  <select name="lapangan_id" class="w-full border p-2 rounded" required>
      @foreach(\App\Models\Lapangan::where('user_id', auth()->id())->get() as $lapangan)
          <option value="{{ $lapangan->id }}" {{ old('lapangan_id', $sesi->lapangan_id ?? '') == $lapangan->id ? 'selected' : '' }}>
              {{ $lapangan->nama_lapangan }}
          </option>
      @endforeach
  </select>
</div>

<div>
  <label class="font-semibold">Tanggal</label>
  <input type="date" name="tanggal_sesi" class="w-full border p-2 rounded" value="{{ old('tanggal_sesi', $sesi->tanggal_sesi ?? '') }}" required>
</div>

<div class="flex space-x-2">
  <div class="w-1/2">
      <label class="font-semibold">Jam Mulai</label>
      <input type="time" name="jam_mulai_sesi" class="w-full border p-2 rounded" value="{{ old('jam_mulai_sesi', $sesi->jam_mulai_sesi ?? '') }}" required>
  </div>
  <div class="w-1/2">
      <label class="font-semibold">Jam Selesai</label>
      <input type="time" name="jam_selesai_sesi" class="w-full border p-2 rounded" value="{{ old('jam_selesai_sesi', $sesi->jam_selesai_sesi ?? '') }}" required>
  </div>
</div>

<div>
  <label class="font-semibold">Harga</label>
  <input type="number" name="harga_per_sesi" class="w-full border p-2 rounded" value="{{ old('harga_per_sesi', $sesi->harga_per_sesi ?? '') }}" required>
</div>

<div>
  <input type="hidden" name="is_available" value="0">
  <label><input type="checkbox" name="is_available" value="1" {{ old('is_available', $sesi->is_available ?? true) ? 'checked' : '' }}>
      Tersedia untuk booking</label>
</div>