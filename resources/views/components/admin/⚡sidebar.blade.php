<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<!-- Wrapper Main Layout Admin -->
@php
    $isProfilActive = request()->routeIs('admin.about-us.*') || request()->routeIs('admin.struktur-katar.*') || request()->routeIs('admin.legal.*');
    $isProgramActive = request()->routeIs('admin.kegiatan.*') || request()->routeIs('admin.usahamandiri.*') || request()->routeIs('admin.kolaborasi.*');
    $isMediaActive = request()->routeIs('admin.foto.*') || request()->routeIs('admin.video.*');
    
    // Tentukan dropdown mana yang terbuka secara default berdasarkan route aktif
    $defaultDropdown = null;
    if ($isProfilActive) { $defaultDropdown = 'profil'; }
    elseif ($isProgramActive) { $defaultDropdown = 'program'; }
    elseif ($isMediaActive) { $defaultDropdown = 'media'; }
@endphp

<div x-data="{ activeDropdown: '{{ $defaultDropdown }}' }" class="relative flex min-h-screen bg-gray-100 font-[poppins]">

    <!-- Backdrop Overlay untuk Mobile (Tutup sidebar saat diklik) -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false"
         x-cloak 
         x-transition:enter="transition-opacity ease-linear duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm lg:hidden"></div>

    <!-- Sidebar Admin -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col bg-slate-900 text-slate-300 transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 shadow-xl border-r border-slate-800">
        
        <!-- Brand / Logo Header -->
        <div class="flex h-16 items-center justify-between px-6 bg-slate-950/50 border-b border-slate-800">
            <a href="#" class="flex items-center gap-3 font-bold text-white tracking-wide">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-md">
                    <img src="{{ asset('img/logo.png') }}" alt="" class="w-full h-full object-contain">
                </div>
                <span class="text-base font-semibold text-white">ADMIN KATAR</span>
            </a>
            <!-- Button Close Mobile -->
            <button @click="sidebarOpen = false" class="text-slate-400 hover:text-white lg:hidden cursor-pointer">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Navigation Links (Scrollable) -->
        <div class="flex-1 overflow-y-auto px-4 py-4 space-y-1 custom-scrollbar">
            
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard</span>
            </a>

            <!-- Group Header -->
            <p class="px-3 pt-4 pb-1 text-[11px] font-semibold tracking-wider text-slate-500 uppercase">Manajemen Konten</p>

            <!-- Dropdown Profil -->
            <div>
                <button @click="activeDropdown = (activeDropdown === 'profil' ? null : 'profil')" 
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2.5 text-sm font-medium transition-all cursor-pointer {{ $isProfilActive ? 'bg-slate-800/80 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <span>Profil</span>
                    </div>
                    <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': activeDropdown === 'profil' }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="activeDropdown === 'profil'" x-collapse class="pl-9 pr-2 py-1 space-y-1">
                    <a href="{{ route('admin.about-us') }}" class="block rounded-md px-3 py-2 text-xs font-medium hover:bg-slate-800 hover:text-white transition-all">Tentang Kami</a>
                    <a href="{{ route('admin.struktur') }}" class="block rounded-md px-3 py-2 text-xs font-medium hover:bg-slate-800 hover:text-white transition-all">Struktur Katar</a>
                    <a href="{{ route('admin.legal') }}" class="block rounded-md px-3 py-2 text-xs font-medium hover:bg-slate-800 hover:text-white transition-all">Dasar Hukum</a>
                </div>
            </div>

            <!-- Running Text -->
            <a href="{{ route('admin.running-text') }}" 
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('admin.event.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <x-gmdi-info class="w-5 h-5"/> 
                <span>Running Text</span>
            </a>

            <!-- Dropdown Program -->
            <div>
                <button @click="activeDropdown = (activeDropdown === 'program' ? null : 'program')" 
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2.5 text-sm font-medium transition-all cursor-pointer {{ $isProgramActive ? 'bg-slate-800/80 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Program</span>
                    </div>
                    <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': activeDropdown === 'program' }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="activeDropdown === 'program'" x-collapse class="pl-9 pr-2 py-1 space-y-1">
                    <a href="{{ route('admin.kegiatan') }}" class="block rounded-md px-3 py-2 text-xs font-medium hover:bg-slate-800 hover:text-white transition-all">Kegiatan</a>
                    <a href="{{ route('admin.usaha') }}" class="block rounded-md px-3 py-2 text-xs font-medium hover:bg-slate-800 hover:text-white transition-all">Usaha Mandiri</a>
                    <a href="{{ route('admin.kolaborasi') }}" class="block rounded-md px-3 py-2 text-xs font-medium hover:bg-slate-800 hover:text-white transition-all">Kolaborasi</a>
                </div>
            </div>

            <!-- Dropdown Media -->
            <div>
                <button @click="activeDropdown = (activeDropdown === 'media' ? null : 'media')" 
                        class="flex w-full items-center justify-between rounded-lg px-3 py-2.5 text-sm font-medium transition-all cursor-pointer {{ $isMediaActive ? 'bg-slate-800/80 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Galeri Media</span>
                    </div>
                    <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': activeDropdown === 'media' }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="activeDropdown === 'media'" x-collapse class="pl-9 pr-2 py-1 space-y-1">
                    <a href="{{ route('admin.foto') }}" class="block rounded-md px-3 py-2 text-xs font-medium hover:bg-slate-800 hover:text-white transition-all">Foto</a>
                    <a href="{{ route('admin.video') }}" class="block rounded-md px-3 py-2 text-xs font-medium hover:bg-slate-800 hover:text-white transition-all">Video</a>
                </div>
            </div>

            <!-- Event -->
            <a href="{{ route('admin.event') }}" 
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('admin.event.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Kelola Event</span>
            </a>

            <!-- Berita -->
            <a href="{{ route('admin.news') }}" 
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('admin.news.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <span>Kelola Berita</span>
            </a>

            <!-- banner and slider -->
            <a href="{{ route('admin.banner') }}" 
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('admin.news.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Banner and Slider</span>
            </a>

            <!-- Kontak -->
            <a href="{{ route('admin.kontak') }}" 
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all {{ request()->routeIs('admin.news.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
               <x-gmdi-contact-phone class="w-5 h-5" />
               <span>Kontak</span>
            </a>

            <!-- Group Header -->
            <p class="px-3 pt-4 pb-1 text-[11px] font-semibold tracking-wider text-slate-500 uppercase">Pengaturan</p>

            <!-- Pengguna / Admin -->
            <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium hover:bg-slate-800 hover:text-white transition-all">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span>Manajemen Account</span>
            </a>

            <a href="#" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium hover:bg-slate-800 hover:text-white transition-all">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Settings</span>
            </a>
        </div>

        <!-- Footer Profile & Logout -->
        <div class="p-4 border-t border-slate-800 bg-slate-950/40">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-9 w-9 rounded-full bg-slate-700 flex items-center justify-center font-bold text-white text-sm">
                        AD
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-medium text-white truncate">Administrator</p>
                        <p class="text-xs text-slate-400 truncate">admin@katar.id</p>
                    </div>
                </div>
                <!-- Tombol Logout -->
                <form method="POST" action="#">
                    @csrf
                    <button type="submit" title="Logout" class="text-slate-400 hover:text-red-400 p-1.5 rounded-lg hover:bg-slate-800 transition-colors cursor-pointer">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

</div>