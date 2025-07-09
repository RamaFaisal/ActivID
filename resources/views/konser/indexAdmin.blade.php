@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto mt-10">
      @if (session('success'))
          <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
              {{ session('success') }}
          </div>
      @endif
      
      @if (session('error'))
          <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
              {{ session('error') }}
          </div>
      @endif  

        <h2 class="text-2xl font-bold mb-4">Daftar Konser Saya</h2>

        <a href="{{ route('konser-admin.create') }}"
            class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 inline-block mb-4">
            + Tambah Konser
        </a>

        @if ($konsers->isEmpty())
            <p class="text-gray-500">Belum ada konser.</p>
        @else
            <table class="w-full text-sm border bg-white rounded">
                <thead class="bg-yellow-100">
                    <tr>
                        <th class="p-2">Nama</th>
                        <th class="p-2">Artis</th>
                        <th class="p-2">Tanggal</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($konsers as $konser)
                        <tr class="border-t">
                            <td class="p-2">{{ $konser->nama_konser }}</td>
                            <td class="p-2">{{ $konser->artis_konser }}</td>
                            <td class="p-2">{{ $konser->tanggal_konser }}</td>
                            <td class="p-2">
                                <span class="text-xs px-2 py-1 bg-gray-200 rounded">{{ $konser->status_konser }}</span>
                            </td>
                            <td class="p-2 space-x-2">
                                <a href="{{ route('konser-admin.edit', $konser->id_konser) }}"
                                    class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('konser-admin.destroy', $konser->id_konser) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin hapus konser ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
