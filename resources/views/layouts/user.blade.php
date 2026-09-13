<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>
        @php
            // Mengambil data setting langsung jika tidak pakai view composer
            $globalSetting = App\Models\identity::first(); 
        @endphp

        @if($globalSetting && $globalSetting->image)
            <!-- Jika logo disimpan berupa nama file/path -->
            <link rel="icon" type="image/png/webp" href="{{ asset('storage/' . $globalSetting->image) }}">
        @endif

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="min-h-screen flex flex-col h-full w-full bg-white select-none">

        @livewire('user.navbar')

        <!-- 2. KONTEN UTAMA -->
        <main class="flex-1 mt-26 w-full h-full">
            {{ $slot }} <!-- Halaman Livewire User Masuk Di Sini -->
        </main>

        @livewire('user.footer')
    </body>
</html>
