@props(['image', 'title', 'location', 'category', 'price', 'link' => '#'])

<div>
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
    <div class="bg-white rounded-lg shadow-sm w-[350px] overflow-hidden">
        <img src="{{ asset($image) }}" alt="{{ $title }}" class="w-full h-40 object-cover">

        <div class="p-4 text-left">
            <p class="text-xs text-gray-500 mb-1">Venue</p>
            <h3 class="text-base font-semibold">{{ $title }}</h3>
            <p class="text-sm text-gray-600">{{ $location }}</p>

            <div class="mt-2 mb-3">
                <span class="inline-block px-3 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800">
                    {{ $category }}
                </span>
            </div>

            <p class="text-sm text-gray-700">
                Mulai dari <span class="font-semibold">{{ $price }}</span> / sesi
            </p>
            <a class="text-blue-500 text-sm underline" href="{{ $link }}">Lihat Detail</a>
        </div>
    </div>
</div>