<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>
    <div class="max-w-6xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Pengajuan Mitra Lapangan</h1>

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

        @if($pengajuan->count())
            <table class="w-full table-auto border border-collapse border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2">Nama</th>
                        <th class="border px-3 py-2">Email</th>
                        <th class="border px-3 py-2">Domisili</th>
                        <th class="border px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuan as $p)
                    <tr class="border">
                        <td class="px-3 py-2">{{ $p->nama }}</td>
                        <td class="px-3 py-2">{{ $p->email }}</td>
                        <td class="px-3 py-2">{{ $p->domisili }}</td>
                        <td class="px-3 py-2">
                            <form action="{{ route('pengajuan.approve', $p->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menyetujui pengajuan ini?')">
                                @csrf
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Setujui</button>
                            </form>
                            
                            <form action="{{ route('pengajuan.reject', $p->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Yakin ingin menolak dan menghapus pengajuan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">Tolak</button>
                            </form>                      
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">Belum ada pengajuan mitra yang masuk.</p>
        @endif
    </div>
</x-app-layout>