<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ActivID')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f5f3f0] text-gray-900 antialiased scroll-smooth">

    {{-- Navbar --}}
    <x-navbar />

    {{-- Konten Tengah --}}
    <main class="min-h-screen bg-[#f5f3f0]">
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-footer />

</body>
</html>