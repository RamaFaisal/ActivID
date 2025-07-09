<div>
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
    <section class="relative w-full h-screen">
    <img src="{{ asset('images/hero-img.png') }}" 
         alt="Futsal Venue" 
         class="absolute inset-0 w-full h-full object-cover brightness-75 z-0">

    <div class="relative z-10 h-full flex flex-col items-start justify-center px-8 md:px-24 text-white">
        <h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight max-w-xl">
            SuperApps Ticketing & Booking Venue
        </h1>
        <p class="text-sm md:text-lg mb-6 max-w-lg text-white/90">
            All in One Platform untuk persewaan fasilitas olahraga dan jasa ticketing atau pendaftaran sebuah event
        </p>
        <div class="flex gap-4">
            <a href="{{ route('lapangan.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded shadow">
                Sewa Lapangan →
            </a>
            <a href="{{route('konser.public.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded shadow">
                Tiket Konser →
            </a>
        </div>
    </div>
</section>
</div>