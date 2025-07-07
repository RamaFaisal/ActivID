<div class="bg-gray-800 text-white rounded-lg p-4 flex items-start gap-4">
    {{-- Icon lokasi --}}
    <div class="pt-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white opacity-70" viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 2a6 6 0 00-6 6c0 4.418 6 10 6 10s6-5.582 6-10a6 6 0 00-6-6zM8 8a2 2 0 114 0 2 2 0 01-4 0z"
                clip-rule="evenodd" />
        </svg>
    </div>

    {{-- Alamat --}}
    <div>
        <h4 class="text-sm font-semibold mb-1">Lokasi Venue</h4>
        <p class="text-sm text-white/80 leading-tight">
            {{ $alamat }}
        </p>
    </div>
</div>