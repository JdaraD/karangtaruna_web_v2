<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
<body class="bg-gray-900 text-white flex min-h-screen">
    @livewire('admin.sidebar')

    <!-- 2. AREA KONTEN (Samping Kanan) -->
    <div class="flex-1 flex flex-col">
        <!-- Header kecil atas untuk admin (opsional) -->
        <header class="bg-gray-800 p-4 shadow-md text-right">
            <span>Halo,</span>
        </header>

        <!-- Konten Utama Admin -->
        <main class="p-8 flex-1 text-gray-100">
            {{ $slot }} <!-- Halaman Livewire Admin Masuk Di Sini -->
        </main>
    </div>

</body>
</html>
