<div class="bg-white rounded-lg overflow-hidden shadow">
    <img src="{{ asset($image) }}" alt="{{ $title }}" class="w-full h-64 object-cover">

    <div class="p-6 space-y-4">
        {{-- Judul + Lokasi --}}
        <div>
            <h2 class="text-xl font-bold">{{ $title }}</h2>
            <p class="text-sm text-gray-600 flex items-center gap-2">
                ⭐ {{ $rating }} · {{ $location }}
            </p>
        </div>

        {{-- Kategori Badge --}}
        <div class="flex flex-wrap gap-2">
            @foreach ($categories as $category)
            <span class="bg-gray-200 text-gray-800 text-xs font-medium px-3 py-1 rounded-full">
                {{ $category }}
            </span>
            @endforeach
        </div>

        {{-- Deskripsi --}}
        <div>
            <h3 class="font-semibold">Deskripsi</h3>
            <p class="text-sm text-gray-700">{{ $description }}</p>
        </div>

        {{-- Aturan Venue --}}
        <div>
            <h3 class="font-semibold">Aturan Venue</h3>
            <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                @foreach ($rules as $rule)
                <li>{{ $rule }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>