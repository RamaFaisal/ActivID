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
      <h2 class="text-xl font-bold mb-4">Scan QR Booking</h2>

      @if(session('success'))
          <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
      @elseif(session('error'))
          <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
      @endif

      <div id="reader" style="width: 100%; max-width: 500px;"></div>

      {{-- Form tersembunyi untuk mengirimkan ID booking --}}
      <form method="POST" action="{{ route('scan.process') }}" id="scanForm" class="hidden">
          @csrf
          <input type="hidden" name="booking_id" id="booking_id">
      </form>
  </div>

  {{-- CDN html5-qrcode --}}
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  <script>
      function onScanSuccess(decodedText, decodedResult) {
          // Misal isi QR = "BookingID:123"
          if (decodedText.startsWith("BookingID:")) {
              let id = decodedText.replace("BookingID:", "").trim();
              document.getElementById('booking_id').value = id;
              document.getElementById('scanForm').submit();
          }
      }

      const html5QrCode = new Html5Qrcode("reader");

      Html5Qrcode.getCameras().then(cameras => {
          if (cameras.length) {
              html5QrCode.start(
                  { facingMode: "environment" },
                  { fps: 10, qrbox: 250 },
                  onScanSuccess
              );
          }
      }).catch(err => {
          alert("Gagal mengakses kamera: " + err);
      });
  </script>
</body>
</html>