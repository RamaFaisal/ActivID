@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Edit Sesi Lapangan</h2>

    <form action="{{ route('sesi.update', $sesi->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('sesi.partials.form', ['sesi' => $sesi])

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update
        </button>
    </form>
</div>
@endsection