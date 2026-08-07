<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<nav x-data="{ mobileMenuOpen: false, activeDropdown: null }" class="relative font-[poppins]">
    {{-- Website Navbar Fixed --}}
    <div class="fixed top-0 inset-x-0 z-50 w-full">
        {{-- Navbar Main Container --}}
        <div id="mainNavbar" class="w-full transition-all duration-300 ease-in-out bg-[#618764] shadow-md">
            
            {{-- Top Header / Navbar --}}
            <div class="relative flex w-[90%] h-18 justify-between items-center px-4 md:px-8 mx-auto">
                
                {{-- Logo & Identity --}}
                <div class="flex w-full h-full justify-center items-center lg:gap-2 md:gap-4 gap-2">
                    {{-- logo --}}
                    <img src="{{ asset('img/logo.png') }}" alt="" class="lg:w-18 lg:h-20 md:w-16 md:h-16 w-14 h-14 rounded-full">
                    
                    {{-- identity name --}}
                    <a href="{{ route('about-us') }}" class="flex flex-col w-full">
                        <p class="font-[poppins] font-medium lg:text-base md:text-sm text-sm text-white">Karang Taruna</p>
                        <p class="font-[poppins] font-normal lg:text-sm md:text-sm text-xs text-gray-200">Desa Waru</p>
                    </a>
                </div>

                {{-- Desktop Menu (LG & MD) --}}
                <div class="hidden lg:flex items-center gap-2 lg:gap-4">
                    @php
                        $isActiveBtnHome = request()->routeIs('home');
                        $isActiveBtnEvent = request()->routeIs('event');
                        $isActiveBtnNews = request()->routeIs('news');
                        $isProfilActive = request()->routeIs('about-us') || request()->routeIs('struktur-katar') || request()->routeIs('legal');
                        $isProgramActive = request()->routeIs('kegiatan') || request()->routeIs('usahamandiri') || request()->routeIs('kolaborasi') || request()->routeIs('detailusaha') || request()->routeIs('kolaborasidetail') || request()->routeIs('detailkolaborasi');
                        $isMediaActive = request()->routeIs('foto') || request()->routeIs('video');
                    @endphp

                    {{-- Beranda --}}
                    <a href="{{ route('home') }}" class="uppercase text-xs lg:text-sm font-medium px-3 py-1.5 rounded-md transition-all {{ $isActiveBtnHome ? 'text-black bg-gray-50 shadow-md' : 'text-white hover:text-black hover:bg-gray-50' }}">
                        Beranda
                    </a>
                        
                    {{-- Dropdown Profil --}}
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" class="uppercase text-xs lg:text-sm inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md font-medium cursor-pointer transition-all {{ $isProfilActive ? 'text-black bg-gray-50 shadow-md' : 'text-white hover:text-black hover:bg-gray-50' }}">
                            Profil
                            <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    
                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-cloak
                             class="absolute left-0 mt-2 w-44 rounded-md shadow-lg bg-white ring-1 ring-black/5 z-50 py-1">
                            <a href="{{ route('about-us') }}" class="uppercase text-xs font-medium block px-4 py-2 text-gray-800 hover:bg-gray-100">Tentang Kami</a>
                            <a href="{{ route('struktur-katar') }}" class="uppercase text-xs font-medium block px-4 py-2 text-gray-800 hover:bg-gray-100">Struktur Katar</a>
                            <a href="{{ route('legal') }}" class="uppercase text-xs font-medium block px-4 py-2 text-gray-800 hover:bg-gray-100">Dasar Hukum</a>
                        </div>
                    </div>
                    
                    {{-- Dropdown Program --}}
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" class="uppercase text-xs lg:text-sm inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md font-medium cursor-pointer transition-all {{ $isProgramActive ? 'text-black bg-gray-50 shadow-md' : 'text-white hover:text-black hover:bg-gray-50' }}">
                            Program
                            <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    
                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-cloak
                             class="absolute left-0 mt-2 w-44 rounded-md shadow-lg bg-white ring-1 ring-black/5 z-50 py-1">
                            <a href="{{ route('kegiatan') }}" class="uppercase text-xs font-medium block px-4 py-2 text-gray-800 hover:bg-gray-100">Kegiatan</a>
                            <a href="{{ route('usahamandiri') }}" class="uppercase text-xs font-medium block px-4 py-2 text-gray-800 hover:bg-gray-100">Usaha Mandiri</a>
                            <a href="{{ route('kolaborasi') }}" class="uppercase text-xs font-medium block px-4 py-2 text-gray-800 hover:bg-gray-100">Kolaborasi</a>
                        </div>
                    </div>

                    {{-- Dropdown Media --}}
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" class="uppercase text-xs lg:text-sm inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md font-medium cursor-pointer transition-all {{ $isMediaActive ? 'text-black bg-gray-50 shadow-md' : 'text-white hover:text-black hover:bg-gray-50' }}">
                            Media
                            <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    
                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-cloak
                             class="absolute left-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black/5 z-50 py-1">
                            <a href="{{ route('foto') }}" class="uppercase text-xs font-medium block px-4 py-2 text-gray-800 hover:bg-gray-100">Foto</a>
                            <a href="{{ route('video') }}" class="uppercase text-xs font-medium block px-4 py-2 text-gray-800 hover:bg-gray-100">Video</a>
                        </div>
                    </div>

                    {{-- Event & Berita --}}
                    <a href="{{ route('event') }}" class="uppercase text-xs lg:text-sm font-medium px-3 py-1.5 rounded-md transition-all {{ $isActiveBtnEvent ? 'text-black bg-gray-50 shadow-md' : 'text-white hover:text-black hover:bg-gray-50' }}">
                        Event
                    </a>
                    <a href="{{ route('news') }}" class="uppercase text-xs lg:text-sm font-medium px-3 py-1.5 rounded-md transition-all {{ $isActiveBtnNews ? 'text-black bg-gray-50 shadow-md' : 'text-white hover:text-black hover:bg-gray-50' }}">
                        Berita
                    </a>

                    {{-- Kontak --}}
                    <a href="#kontak" class="uppercase text-xs lg:text-sm font-medium text-white hover:text-black hover:bg-gray-50 px-3 py-1.5 rounded-md transition-all">
                        Kontak
                    </a>
                </div>

                {{-- Hamburger Button (Mobile & Tablet) --}}
                <div class="flex lg:hidden items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white hover:text-gray-200 p-2 focus:outline-none cursor-pointer">
                        {{-- Icon Hamburger --}}
                        <svg x-show="!mobileMenuOpen" class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        {{-- Icon Close (X) --}}
                        <svg x-show="mobileMenuOpen" x-cloak class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

            </div>

            {{-- Running Text --}}
            <div class="flex justify-center items-center h-8 bg-[#9CB080] border-t border-white/10 px-4">
                <div class="flex items-center gap-3 w-full max-w-7xl">
                    <div class="flex items-center gap-2 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#006FFF" class="w-5 h-5">
                            <path d="M16.881 4.345A23.112 23.112 0 0 1 8.25 6H7.5a5.25 5.25 0 0 0-.88 10.427 21.593 21.593 0 0 0 1.378 3.94c.464 1.004 1.674 1.32 2.582.796l.657-.379c.88-.508 1.165-1.593.772-2.468a17.116 17.116 0 0 1-.628-1.607c1.918.258 3.76.75 5.5 1.446A21.727 21.727 0 0 0 18 11.25c0-2.414-.393-4.735-1.119-6.905ZM18.26 3.74a23.22 23.22 0 0 1 1.24 7.51 23.22 23.22 0 0 1-1.41 7.992.75.75 0 1 0 1.409.516 24.555 24.555 0 0 0 1.415-6.43 2.992 2.992 0 0 0 .836-2.078c0-.807-.319-1.54-.836-2.078a24.65 24.65 0 0 0-1.415-6.43.75.75 0 1 0-1.409.516c.059.16.116.321.17.483Z" />
                        </svg>                   
                        <div class="h-4 w-[2px] bg-white/40"></div>
                    </div>

                    <div class="overflow-hidden w-full text-white whitespace-nowrap">
                        <div class="inline-block animate-marquee tracking-wide">
                            <p class="normal-case text-xs md:text-sm font-medium text-white">
                                Selamat Datang di Website Resmi Karang Taruna Desa Waru — Wadah Informasi, Kegiatan, dan Pemberdayaan Pemuda.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Menu Slide-Over (Drawer) --}}
    <!-- Backdrop Overlay -->
    <div x-show="mobileMenuOpen" 
         @click="mobileMenuOpen = false" 
         x-cloak
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 lg:hidden"></div>

    <!-- Drawer Menu -->
    <div x-show="mobileMenuOpen"
         x-cloak
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed inset-y-0 right-0 max-w-xs w-full bg-[#618764] z-50 shadow-2xl flex flex-col justify-between overflow-y-auto lg:hidden">
        
        <div class="p-6">
            <!-- Header Mobile Menu -->
            <div class="flex items-center justify-between border-b border-white/20 pb-4 mb-6">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-10 h-10 rounded-full border border-white/30">
                    <span class="font-semibold text-white text-base">Menu Navigasi</span>
                </div>
                <button @click="mobileMenuOpen = false" class="text-white hover:text-gray-200 cursor-pointer">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- List Links Mobile -->
            <div class="flex flex-col space-y-2">
                
                {{-- Beranda --}}
                <a href="{{ route('home') }}" class="uppercase text-sm font-medium px-4 py-2.5 rounded-lg text-white hover:bg-white/10 transition-colors {{ request()->routeIs('home') ? 'bg-white/20 font-bold' : '' }}">
                    Beranda
                </a>

                {{-- Accordion Profil --}}
                <div>
                    <button @click="activeDropdown = (activeDropdown === 'profil' ? null : 'profil')" class="w-full flex justify-between items-center uppercase text-sm font-medium px-4 py-2.5 rounded-lg text-white hover:bg-white/10 transition-colors">
                        <span>Profil</span>
                        <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': activeDropdown === 'profil' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeDropdown === 'profil'" x-collapse class="pl-6 space-y-1 my-1">
                        <a href="{{ route('about-us') }}" class="block text-xs uppercase text-gray-100 hover:text-white py-2 px-3 rounded-md hover:bg-white/10">Tentang Kami</a>
                        <a href="{{ route('struktur-katar') }}" class="block text-xs uppercase text-gray-100 hover:text-white py-2 px-3 rounded-md hover:bg-white/10">Struktur Katar</a>
                        <a href="{{ route('legal') }}" class="block text-xs uppercase text-gray-100 hover:text-white py-2 px-3 rounded-md hover:bg-white/10">Dasar Hukum</a>
                    </div>
                </div>

                {{-- Accordion Program --}}
                <div>
                    <button @click="activeDropdown = (activeDropdown === 'program' ? null : 'program')" class="w-full flex justify-between items-center uppercase text-sm font-medium px-4 py-2.5 rounded-lg text-white hover:bg-white/10 transition-colors">
                        <span>Program</span>
                        <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': activeDropdown === 'program' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeDropdown === 'program'" x-collapse class="pl-6 space-y-1 my-1">
                        <a href="{{ route('kegiatan') }}" class="block text-xs uppercase text-gray-100 hover:text-white py-2 px-3 rounded-md hover:bg-white/10">Kegiatan</a>
                        <a href="{{ route('usahamandiri') }}" class="block text-xs uppercase text-gray-100 hover:text-white py-2 px-3 rounded-md hover:bg-white/10">Usaha Mandiri</a>
                        <a href="#" class="block text-xs uppercase text-gray-100 hover:text-white py-2 px-3 rounded-md hover:bg-white/10">Kolaborasi</a>
                    </div>
                </div>

                {{-- Accordion Media --}}
                <div>
                    <button @click="activeDropdown = (activeDropdown === 'media' ? null : 'media')" class="w-full flex justify-between items-center uppercase text-sm font-medium px-4 py-2.5 rounded-lg text-white hover:bg-white/10 transition-colors">
                        <span>Media</span>
                        <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': activeDropdown === 'media' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeDropdown === 'media'" x-collapse class="pl-6 space-y-1 my-1">
                        <a href="{{ route('foto') }}" class="block text-xs uppercase text-gray-100 hover:text-white py-2 px-3 rounded-md hover:bg-white/10">Foto</a>
                        <a href="{{ route('video') }}" class="block text-xs uppercase text-gray-100 hover:text-white py-2 px-3 rounded-md hover:bg-white/10">Video</a>
                    </div>
                </div>

                {{-- Event & Berita --}}
                <a href="{{ route('event') }}" class="uppercase text-sm font-medium px-4 py-2.5 rounded-lg text-white hover:bg-white/10 transition-colors {{ request()->routeIs('event') ? 'bg-white/20 font-bold' : '' }}">
                    Event
                </a>
                <a href="{{ route('news') }}" class="uppercase text-sm font-medium px-4 py-2.5 rounded-lg text-white hover:bg-white/10 transition-colors {{ request()->routeIs('news') ? 'bg-white/20 font-bold' : '' }}">
                    Berita
                </a>
                <a href="#kontak" @click="mobileMenuOpen = false" class="uppercase text-sm font-medium px-4 py-2.5 rounded-lg text-white hover:bg-white/10 transition-colors">
                    Kontak
                </a>

            </div>
        </div>

        <!-- Footer Off-Canvas -->
        <div class="p-6 border-t border-white/20 bg-black/10">
            <p class="text-xs text-center text-gray-200">© Karang Taruna Desa Waru</p>
        </div>
    </div>
</nav>