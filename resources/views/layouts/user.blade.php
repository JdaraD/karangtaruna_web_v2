<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
<body class="bg-gray-100">

    @livewire('user.navbar')

    <!-- 2. KONTEN UTAMA -->
    <main class="container mx-auto mt-6 px-4">
        {{ $slot }} <!-- Halaman Livewire User Masuk Di Sini -->
    </main>

</body>
</html>
