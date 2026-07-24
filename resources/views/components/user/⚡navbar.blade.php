<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="relative">
    {{-- website --}}
    <div class="fixed top-0 left-0 right-0 z-100 w-full">
        {{-- Navbar Sticky --}}
        <div id="mainNavbar" class="sticky top-0 z-50 w-full transition-all duration-300 ease-in-out">
                
            {{-- Navbar --}}
            <div class="flex w-full lg:h-18 md:h-18 h-18 justify-center bg-[#618764]">
            
                <div class="grid lg:grid-cols-6 md:grid-cols-3 grid-cols-4 gap-4 h-full w-[90%]">
                        
                    <div class="flex lg:col-span-1 md:col-span-2 col-span-3 w-full h-full lg:justify-center lg:items-center md:justify-center md:items-center justify-end items-center lg:gap-2 md:gap-4 gap-2">
                        {{-- logo --}}
                        <img src="{{ asset('img/logo.png') }}" alt="" class="lg:w-18 lg:h-18 md:w-16 md:h-16 w-14 h-14 rounded-full">
                        
                        {{-- identity name --}}
                        <a href="#" class="flex flex-col w-40">
                            <p class="font-[poppins] font-medium lg:text-base md:text-base text-base">Karang Taruna</p>
                            <p class="font-[poppins] font-normal lg:text-sm md:text-sm text-sm">Desa Waru</p>
                        </a>
                    </div>
                    {{-- Logo End --}}
            
                    {{-- Menu Start --}}
                    <div class="lg:flex md:hidden hidden col-span-4 w-full h-full justify-center items-center lg:gap-6 md:gap-4 gap-6">
                        <a href="#" class="uppercase font-[poppins] text-sm font-medium text-black hover:bg-gray-50 px-4 py-2 rounded-md">beranda</a>
                            
                        <div x-data="{ open: false }" class="relative inline-block text-left">
                            @php
                                $isProfilActive = request()->routeIs('tentang') || request()->routeIs('sktuktur') ||request()->routeIs('dasarhukum');
                            @endphp
                            <button @click="open = !open" class="uppercase font-[poppins] text-sm inline-flex justify-center w-full rounded-md px-4 py-2 font-medium text-black hover:bg-gray-50 {{ $isProfilActive ? 'bg-gray-50 shadow-md' : '' }}">
                                profil
                            </button>
                        
                            <div x-show="open" @click.outside="open = false" x-transition
                                class="absolute left-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-opacity-5 z-50">
                                <div class="py-1 flex flex-col justify-center items-center gap-2">
                                    <a href="#" class="uppercase font-[poppins] w-37.5 text-sm block px-4 py-2 text-black hover:bg-gray-200 rounded-md">tentang kami</a>
                                    <a href="#" class="uppercase font-[poppins] w-37.5 text-sm block px-4 py-2 text-black hover:bg-gray-200 rounded-md">struktur katar</a>
                                    <a href="#" class="uppercase font-[poppins] w-37.5 text-sm block px-4 py-2 text-black hover:bg-gray-200 rounded-md">dasar hukum</a>
                                </div>
                            </div>
                        </div>
                        
                        <div x-data="{ open: false }" class="relative inline-block text-left">
                            @php
                                $isProgramActive = request()->routeIs('menukegiatan') || request()->routeIs('usahamandiri') ||request()->routeIs('kolaborasi') || request()->routeIs('kegiatan') || request()->routeIs('detailusaha') || request()->routeIs('kolaborasidetail') || request()->routeIs('detailkolaborasi');
                            @endphp

                            <button @click="open = !open" class="uppercase font-[poppins] text-sm inline-flex justify-center w-full rounded-md px-4 py-2 font-medium text-black hover:bg-gray-50 {{ $isProgramActive ? 'bg-gray-50 shadow-md' : '' }}">
                                program
                            </button>
                        
                            <div x-show="open" @click.outside="open = false" x-transition
                                class="absolute left-0 mt-2 w-38.5 rounded-md shadow-lg bg-white ring-opacity-5 z-50">
                                <div class="py-1 flex flex-col justify-center items-center gap-2">
                                    <a href="#" class="uppercase font-[poppins] w-36 text-sm block px-4 py-2 text-black hover:bg-gray-200 rounded-md">kegiatan</a>
                                    <a href="#" class="uppercase font-[poppins] w-36 text-sm block px-4 py-2 text-black hover:bg-gray-200 rounded-md">usaha mandiri</a>
                                    <a href="#" class="uppercase font-[poppins] w-36 text-sm block px-4 py-2 text-black hover:bg-gray-200 rounded-md">kolaborasi</a>
                                </div>
                            </div>
                        </div>
            
                        <div x-data="{ open: false }" class="relative inline-block text-left">
                            @php
                                $isMediaActive = request()->routeIs('foto') || request()->routeIs('video');
                            @endphp

                            <button @click="open = !open"
                                class="uppercase font-[poppins] text-sm inline-flex justify-center w-full rounded-md px-4 py-2 font-medium text-black hover:bg-gray-50
                                {{ $isMediaActive ? 'bg-gray-50 shadow-md' : '' }}">
                                media
                            </button>
                        
                            <div x-show="open" @click.outside="open = false" x-transition
                                class="absolute left-0 mt-2 w-35 rounded-md shadow-lg bg-white ring-opacity-5 z-50">
                                <div class="py-1 flex flex-col justify-center items-center gap-2">
                                    <a href="#" class="uppercase font-[poppins] w-32.5 text-sm block px-4 py-2 text-black hover:bg-gray-200 rounded-md">foto</a>
                                    <a href="#" class="uppercase font-[poppins] w-32.5 text-sm block px-4 py-2 text-black hover:bg-gray-200 rounded-md">video</a>
                                </div>
                            </div>
                        </div>
            
                        <a href="#" class="uppercase font-[poppins] text-sm font-medium focus:bg-gray-50 hover:bg-gray-50 px-4 py-2 rounded-md">event</a>
                        <a href="#" class="uppercase font-[poppins] text-sm font-medium hover:bg-gray-50 px-4 py-2 rounded-md">berita</a>
                    </div>
                    {{-- Menu End --}}
            
                    {{-- Kontak Start --}}
                    <div class="lg:flex md:flex flex lg:col-span-1 md:col-span-1 col-span-1 w-full h-full justify-center items-center lg:gap-4 md:gap-4 gap-0">
                        <a href="#kontak">
                            <p class="uppercase font-[poppins] lg:text-sm md:text-sm text-[12px] font-medium hover:bg-gray-50 px-4 py-2 rounded-md">kontak</p>
                        </a>
                    </div>
                    {{-- Kontak End --}}
                </div>
            
            </div>
            {{-- Navbar --}}
            
            {{-- Running Text --}}
            <div class="flex justify-center items-center lg:h-8.75 md:h-8.75 h-7 bg-[#9CB080]">
                <div class="flex size-[80%] w-[90%] gap-1">
                    <div class="flex justify-center items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#006FFF" class="size-7">
                            <path d="M16.881 4.345A23.112 23.112 0 0 1 8.25 6H7.5a5.25 5.25 0 0 0-.88 10.427 21.593 21.593 0 0 0 1.378 3.94c.464 1.004 1.674 1.32 2.582.796l.657-.379c.88-.508 1.165-1.593.772-2.468a17.116 17.116 0 0 1-.628-1.607c1.918.258 3.76.75 5.5 1.446A21.727 21.727 0 0 0 18 11.25c0-2.414-.393-4.735-1.119-6.905ZM18.26 3.74a23.22 23.22 0 0 1 1.24 7.51 23.22 23.22 0 0 1-1.41 7.992.75.75 0 1 0 1.409.516 24.555 24.555 0 0 0 1.415-6.43 2.992 2.992 0 0 0 .836-2.078c0-.807-.319-1.54-.836-2.078a24.65 24.65 0 0 0-1.415-6.43.75.75 0 1 0-1.409.516c.059.16.116.321.17.483Z" />
                        </svg>                   
                        <p class="lg:border-2 md:border-2 border lg:h-6.75 md:h-6.75 h-5"></p>
                    </div>

                    <div class="flex justify-center items-center px-1 w-full overflow-hidden text-white py-3 whitespace-nowrap">
                        <div class="inline-block animate-marquee tracking-wide">
                            <p class="normal-case font-[poppins] lg:text-sm md:text-sm text-xs font-medium text-white">
                                lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Running Text --}}
            
        </div>
    </div>
    {{-- website --}}
</div>