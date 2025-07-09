@extends('layouts.admin')

@section('content')
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white border rounded shadow">
        <h2 class="text-xl font-bold mb-4">Tambah Lapangan Baru</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-500 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('lapangan-admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('lapangan.partials.form', ['lapangan' => null])

            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Simpan
            </button>
            <button>
                <a href="{{ route('lapangan-admin.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Kembali
                </a>
            </button>
        </form>
    </div>
@endsection