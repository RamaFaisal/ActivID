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
  <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
      <h2 class="text-2xl font-bold mb-4">Konfirmasi Booking</h2>

      <div class="mb-4 text-sm text-gray-700 space-y-1">
          <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
          <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
          <p><strong>Nomor Telepon:</strong> {{ Auth::user()->nomor_telepon }}</p>
          <p><strong>Lapangan:</strong> {{ $sesi->lapangan->nama_lapangan }}</p>
          <p><strong>Alamat:</strong> {{ $sesi->lapangan->alamat }}</p>
          <p><strong>Tanggal:</strong> {{ $sesi->tanggal_sesi }}</p>
          <p><strong>Jam:</strong> {{ $sesi->jam_mulai_sesi }} - {{ $sesi->jam_selesai_sesi }}</p>
          <p><strong>Durasi:</strong>
              {{ \Carbon\Carbon::parse($sesi->jam_mulai_sesi)->diffInMinutes(\Carbon\Carbon::parse($sesi->jam_selesai_sesi)) }} menit
          </p>
          <p><strong>Total Harga:</strong> Rp{{ number_format($sesi->harga_per_sesi) }}</p>
      </div>

      {{-- Simulasi pembayaran langsung --}}
      <form method="POST" action="{{ route('sewa.store', $sesi->id) }}">
          @csrf
          <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
              Bayar & Booking Sekarang
          </button>
      </form>
  </div>
</body>
</html>