@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Tambah Sesi</h2>

    <form action="{{ route('sesi.store') }}" method="POST">
        @csrf

        @include('sesi.partials.form', ['sesi' => null])

        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Simpan
        </button>
    </form>
</div>
@endsection