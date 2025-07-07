<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
    <div class="bg-white rounded shadow-md overflow-hidden w-[220px]">
        <img src="{{ asset($image) }}" alt="{{ $title }}" class="w-full h-64 object-cover">

        <div class="p-4">
            <h3 class="font-semibold text-base mb-1">{{ $title }}</h3>
            <p class="text-sm text-gray-700">{{ $date }}</p>
            <p class="text-sm text-gray-500 mb-3">{{ $location }}</p>
            <a href="{{ $link }}"
                class="block bg-blue-600 text-white text-center rounded py-1 text-sm hover:bg-blue-700">
                Pesan
            </a>
        </div>
    </div>
</div>