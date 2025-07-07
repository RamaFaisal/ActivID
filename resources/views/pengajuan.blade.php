<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Form Pengajuan Mitra</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<body>
  @if(session('success'))
      <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
          {{ session('success') }}
      </div>
  @endif

  @if(session('error'))
      <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
          {{ session('error') }}
      </div>
  @endif

  <form action="{{ route('pengajuan.store') }}" method="POST">
    @csrf
    <input type="text" name="nama" placeholder="Nama" value="{{ old('nama') }}"><br>
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"><br>
    <input type="text" name="nomor_telepon" placeholder="Nomor HP" value="{{ old('nomor_hp') }}"><br>
    <input type="text" name="domisili" placeholder="Domisili" value="{{ old('domisili') }}"><br>
    
    <select name="jenis_pengajuan">
        <option value="Gabung Mitra" {{ old('jenis_pengajuan') == 'Gabung Mitra' ? 'selected' : '' }}>Gabung Mitra</option>
    </select><br>

    <button type="submit">Kirim</button>
  </form>
</body>
</html>