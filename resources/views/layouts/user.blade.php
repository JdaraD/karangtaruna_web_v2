<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="min-h-screen flex flex-col h-full w-full bg-white">

        @livewire('user.navbar')

        <!-- 2. KONTEN UTAMA -->
        <main class="flex-1 mt-26.5 bg-gray-200 w-full h-full">
            {{ $slot }} <!-- Halaman Livewire User Masuk Di Sini -->
        </main>

        @livewire('user.footer')
    </body>
</html>
