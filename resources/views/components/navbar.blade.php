<nav class="bg-white shadow-lg px-4 py-3">
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
            <a href="/sewa-lapangan" class="text-gray-700 hover:text-blue-600">Sewa Lapangan</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Partner With Us</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Blog</a>
        </div>
        <a href="#" class="bg-blue-600 text-white px-5 py-1 rounded-lg hidden md:flex font-semibold hover:bg-blue-700">Login</a>

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
        <li><a href="#" class="block text-gray-800 hover:text-blue-600">Sewa Lapangan</a></li>
        <li><a href="#" class="block text-gray-800 hover:text-blue-600">Partner With Us</a></li>
        <li><a href="#" class="block text-gray-800 hover:text-blue-600">Blog</a></li>
    </ul>

    <!-- Tombol Masuk dan Daftar -->
    <div class="space-y-3">
        <a href="#" class="block border border-gray-600 text-center py-2 rounded hover:bg-gray-100">Masuk</a>
        <a href="#"
            class="block bg-gradient-to-r from-orange-400 to-orange-500 text-white text-center py-2 rounded hover:opacity-90">Daftar</a>
    </div>
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