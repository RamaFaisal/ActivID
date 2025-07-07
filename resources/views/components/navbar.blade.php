<nav x-data="{ open: false }" class="bg-white shadow-lg px-4 py-3">
    <div class="container mx-auto flex md:justify-between gap-4 items-center">
        <!-- Logo -->
        <button id="sidebar-toggle" class="md:hidden text-gray-700 text-2xl focus:outline-none">
            ☰
        </button>
        <div class="flex items-center gap-2">
            <a href="/"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-10">
            <a href="#" class="text-gray-700 hover:text-blue-600">Tiket Konser</a>
            <a href="{{ route('lapangan.index')}}" class="text-gray-700 hover:text-blue-600">Sewa Lapangan</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Partner With Us</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Blog</a>
        </div>
        
        <!-- Jika belum login (Guest) -->
        @guest
        <a href="/login" class="bg-blue-600 text-white px-5 py-1 rounded-lg hidden md:flex font-semibold hover:bg-blue-700">
            Login
        </a>
        @endguest

        <!-- Jika sudah login (Authenticated) -->
        @auth
        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>

                        <div class="ms-1">{{ Auth::user()->name }}</div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('dashboard')">
                        {{ __('Dashboard') }}
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
        @endauth
        <!-- Mobile Hamburger -->
    </div>
</nav>

<!-- Sidebar Menu (Mobile only) -->
<div id="sidebar"
    class="fixed top-0 left-0 w-64 h-full bg-white shadow-lg z-50 p-6 transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden">

    <!-- Close button -->
    <button id="sidebar-close" class="text-gray-700 text-xl mb-6">✖️</button>

    <h2 class="text-lg font-semibold mb-4">Menu</h2>
    <ul class="space-y-4 mb-6">
        <li><a href="#" class="block text-gray-800 hover:text-blue-600">Tiket Konser</a></li>
        <li><a href="{{ route('lapangan.index')}}" class="block text-gray-800 hover:text-blue-600">Sewa Lapangan</a></li>
        <li><a href="#" class="block text-gray-800 hover:text-blue-600">Partner With Us</a></li>
        <li><a href="#" class="block text-gray-800 hover:text-blue-600">Blog</a></li>
    </ul>

    <!-- Auth Section (Mobile) -->
    @guest
        <div class="space-y-3">
            <a href="/login" class="block border border-gray-600 text-center py-2 rounded hover:bg-gray-100">Masuk</a>
            <a href="/register"
                class="block bg-gradient-to-r from-orange-400 to-orange-500 text-white text-center py-2 rounded hover:opacity-90">Daftar</a>
        </div>
    @endguest

    @auth
        <div class="border-t pt-4 mt-4">
            <p class="text-gray-700 mb-2">Hi, {{ Auth::user()->name }}</p>
            <a href="{{ route('dashboard')}}" class="block text-gray-800 hover:text-blue-600 mb-2">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="block text-gray-800 hover:text-blue-600 mb-2">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-left text-red-600 hover:text-red-800">Logout</button>
            </form>
        </div>
    @endauth
</div>

<!-- Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-40 z-40 hidden md:hidden"></div>

<!-- JS Toggle Sidebar -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const closeBtn = document.getElementById('sidebar-close');

        const openSidebar = () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        };

        const closeSidebar = () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        };

        toggleBtn.addEventListener('click', openSidebar);
        closeBtn.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);
    });
</script>