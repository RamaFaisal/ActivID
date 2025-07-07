@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Manajemen User</h2>

    @if(session('success'))
        <div class="bg-green-100 p-3 text-green-700 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full bg-white rounded shadow text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4">#</th>
                <th class="py-2 px-4">Nama</th>
                <th class="py-2 px-4">Email</th>
                <th class="py-2 px-4">Role</th>
                <th class="py-2 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $user->id }}</td>
                    <td class="py-2 px-4">{{ $user->name }}</td>
                    <td class="py-2 px-4">{{ $user->email }}</td>
                    <td class="py-2 px-4">{{ $user->roles->pluck('name')->first() ?? '-' }}</td>
                    <td class="py-2 px-4 space-x-2">
                        <a href="{{ route('superadmin.edit', $user->id) }}" class="text-blue-600 underline">Edit</a>
                        <form action="{{ route('superadmin.destroy', $user->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus user ini?')" class="text-red-600 underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
