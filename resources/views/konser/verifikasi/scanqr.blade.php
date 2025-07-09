@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow rounded mt-10 text-center">
    <h1 class="text-2xl font-bold mb-4">Scan Tiket QR</h1>

    <div id="reader" class="mx-auto w-full"></div>

    <p id="scan-status" class="mt-4 text-sm text-gray-600">Arahkan kamera ke QR Code...</p>
</div>

{{-- CDN script sudah dimuat dari layout atau tambahkan di bawah --}}
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        if (decodedText) {
            window.location.href = `/scan/${decodedText}`;
        }
    }

    const html5QrCode = new Html5Qrcode("reader");

    Html5Qrcode.getCameras().then(cameras => {
        if (cameras.length) {
            html5QrCode.start(
                { facingMode: "environment" }, // kamera belakang
                { fps: 10, qrbox: 250 },
                onScanSuccess
            );
        }
    }).catch(err => {
        alert("Gagal mengakses kamera: " + err);
    });
</script>

@endsection
