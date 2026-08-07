<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body x-data="{ sidebarOpen: false }" class="bg-gray-900 text-white flex min-h-screen">
        @livewire('admin.sidebar')

        <!-- 2. AREA KONTEN (Samping Kanan) -->
        <div class="flex-1 flex flex-col">
            <!-- Header kecil atas untuk admin (opsional) -->
            @livewire('admin.header')

            <!-- Konten Utama Admin -->
            <main class="flex flex-1 p-6 ">
                {{ $slot }} <!-- Halaman Livewire Admin Masuk Di Sini -->
            </main>
        </div>

    </body>
</html>
