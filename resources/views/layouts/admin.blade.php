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
        @if (!request()->routeIs('login') && !request()->routeIs('registrasi'))
            @livewire('admin.sidebar')
        @endif

        <!-- 2. AREA KONTEN (Samping Kanan) -->
        <div class="flex-1 flex flex-col">
            <!-- Header kecil atas untuk admin (opsional) -->
            
            @if (!request()->routeIs('login') && !request()->routeIs('registrasi'))
                @livewire('admin.header')
            @endif

                <!-- Konten Utama Admin -->
            @if (!request()->routeIs('login') && !request()->routeIs('registrasi'))
                <main class="relative flex w-full h-full overflow-hidden p-6">
                    {{ $slot }} <!-- Halaman Livewire Admin Masuk Di Sini -->
                </main>
            @else
                <main class="relative flex w-full h-full overflow-hidden">
                    {{ $slot }} <!-- Halaman Livewire Admin Masuk Di Sini -->
                </main>
            @endif
        </div>
            
        </body>
</html>
