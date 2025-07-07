<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold mb-4">Fasilitas</h3>

    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
        @foreach ($items as $item)
        <div class="flex items-center gap-2">
            {{-- Icon titik/check (bisa diganti SVG/icon sesuai kebutuhan) --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 shrink-0" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>

            <span class="text-sm text-gray-800">{{ $item }}</span>
        </div>
        @endforeach
    </div>
</div>