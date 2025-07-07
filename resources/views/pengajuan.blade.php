@extends('layouts.app')

@section('content')
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
@endsection