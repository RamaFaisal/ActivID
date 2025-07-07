<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  @if (Auth::user()->hasRole('admin_lapangan'))
  <div class="max-w-6xl mx-auto mt-10">
      <h2 class="text-2xl font-bold mb-6">Daftar Booking Masuk</h2>

      @if(session('success'))
          <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
      @elseif(session('error'))
          <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
      @endif

      <div class="overflow-x-auto bg-white p-4 rounded shadow">
          <table class="w-full text-sm text-left">
              <thead>
                  <tr class="bg-gray-100 border-b">
                      <th class="py-2 px-4">#</th>
                      <th class="py-2 px-4">Nama User</th>
                      <th class="py-2 px-4">Lapangan</th>
                      <th class="py-2 px-4">Tanggal</th>
                      <th class="py-2 px-4">Jam</th>
                      <th class="py-2 px-4">Total</th>
                      <th class="py-2 px-4">Status</th>
                      <th class="py-2 px-4">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse($bookings as $booking)
                      <tr class="border-b hover:bg-gray-50">
                          <td class="py-2 px-4">{{ $booking->id_sewa }}</td>
                          <td class="py-2 px-4">{{ $booking->user->name }}</td>
                          <td class="py-2 px-4">{{ $booking->lapangan->nama_lapangan }}</td>
                          <td class="py-2 px-4">{{ $booking->tanggal_sewa }}</td>
                          <td class="py-2 px-4">{{ $booking->jam_mulai_sewa }} - {{ $booking->jam_selesai_sewa }}</td>
                          <td class="py-2 px-4">Rp{{ number_format($booking->total_harga_sewa) }}</td>
                          <td class="py-2 px-4">{{ ucfirst($booking->status_verifikasi_admin) }}</td>
                          <td class="py-2 px-4">
                              @if($booking->status_verifikasi_admin == 'menunggu')
                                  <form action="{{ route('booking.approve', $booking->id_sewa) }}" method="POST">
                                      @csrf
                                      <button type="submit"
                                          class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                          Setujui Booking
                                      </button>
                                  </form>
                              @else
                                  <span class="text-gray-500 italic">Disetujui</span>
                              @endif
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="8" class="py-4 text-center text-gray-500">Tidak ada booking.</td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  </div>

  @elseif (Auth::user()->hasRole('user'))
  <div class="max-w-4xl mx-auto mt-10">
      <h2 class="text-2xl font-bold mb-6">Riwayat Booking Saya</h2>

      <div class="space-y-4">
          @forelse($bookings as $booking)
              <div class="border p-4 rounded shadow bg-white">
                  <p class="font-semibold">Booking #{{ $booking->id_sewa }}</p>
                  <p>Lapangan: {{ $booking->lapangan->nama_lapangan }}</p>
                  <p>Tanggal: {{ $booking->tanggal_sewa }}</p>
                  <p>Jam: {{ $booking->jam_mulai_sewa }} - {{ $booking->jam_selesai_sewa }}</p>
                  <p>Status Verifikasi:
                      <span class="font-semibold {{ $booking->status_verifikasi_admin === 'disetujui' ? 'text-green-600' : 'text-yellow-600' }}">
                          {{ ucfirst($booking->status_verifikasi_admin) }}
                      </span>
                  </p>
                  <p>Status Check-in:
                      <span class="{{ $booking->status_checkin ? 'text-green-600' : 'text-red-600' }}">
                          {{ $booking->status_checkin ? 'Sudah Check-in' : 'Belum Check-in' }}
                      </span>
                  </p>

                  @if($booking->qr_code_verifikasi_sewa && $booking->status_verifikasi_admin === 'disetujui')
                      <div class="mt-3">
                          <p class="text-sm text-gray-500">Tunjukkan QR ini ke petugas saat check-in:</p>
                          <img src="{{ asset('storage/' . $booking->qr_code_verifikasi_sewa) }}" alt="QR Code" class="w-32 mt-2">
                      </div>
                  @endif
              </div>
          @empty
              <p class="text-gray-600">Belum ada booking.</p>
          @endforelse
      </div>
  </div>
  @endif
</body>
</html>