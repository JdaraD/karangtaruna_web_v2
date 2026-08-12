<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'struktur'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <!-- Header Bagian Struktur -->
    <article class="flex flex-none gap-2 items-center">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Struktur</h1>
    </article>
    
    <!-- 1. Bagian Gambar Bagan Struktur Organisasi -->
    <article class="flex flex-wrap w-full gap-4 items-center">
        <div class="flex flex-col justify-stretch items-center w-full gap-2 p-4 lg:h-76 h-auto bg-white rounded-md shadow-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Bagan Struktur Organisasi</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                        <x-css-eye class="h-4 w-4 text-white"/>
                    </div>
                    <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </div>
                    <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                        <x-bi-trash class="h-4 w-4 text-white"/>
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center p-2 border border-gray-200 rounded-md w-full bg-gray-50">
                <img src="{{ asset('img/struktur.png') }}" alt="Struktur Organisasi" class="h-54 w-auto object-contain rounded-md shadow-sm">
            </div>
        </div>
    </article>

    <!-- 2. Bagian Informasi Pengurus & Kartu Ketua -->
    <article class="flex flex-wrap w-full gap-4 items-center">
        <div class="flex flex-col justify-stretch items-center lg:w-[39%] w-full gap-4 p-4 lg:h-76 h-full bg-white rounded-md shadow-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center">
                <div class="flex flex-col">
                    <p class="font-semibold text-base text-black capitalize">Pengurus Karang Taruna</p>
                    <p class="text-gray-500 font-normal text-sm">Desa Waru 2023 - 2031</p>
                </div>
                <div class="flex w-auto gap-1 justify-end items-center">
                    <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-css-eye class="h-4 w-4 text-white"/>
                    </div>
                    <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </div>
                    <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-bi-trash class="h-4 w-4 text-white"/>
                    </div>
                </div>
            </div>

            <!-- Card Ketua -->
            <div class="flex justify-center w-full">
                <div class="relative flex flex-col lg:w-38 md:w-32 w-22 lg:h-48 md:h-42 h-42 rounded-md shadow-md hover:scale-105 duration-150 transition-transform ease-in-out bg-white border border-gray-200">
                    <div class="w-full h-[90%] flex items-center justify-center p-2">
                        <img src="{{ asset('img/foto.jpg') }}" alt="Ketua" class="w-full h-full object-contain rounded-md">
                    </div>
                    <div class="w-full h-[10%] flex flex-col justify-center items-center bg-gray-200 rounded-b-md">
                        <p class="text-black font-semibold text-sm normal-case">Sekretaris</p>
                    </div>
                    <div class="absolute top-0 left-0 w-full h-full bg-gray-400 bg-opacity-90 opacity-0 hover:opacity-90 duration-150 transition-opacity ease-in-out rounded-md z-10">
                        <div class="flex flex-col w-full h-full justify-center items-center gap-2 p-2 whitespace-normal">
                            <p class="font-semibold lg:text-base text-xs text-black normal-case">Nama Pengurus</p>
                            <p class="text-black font-normal text-xs text-center normal-case">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Bagian List Pengurus (Sekretaris, dll) -->
        <div class="flex flex-col justify-stretch items-center lg:w-[59.7%] w-full gap-4 p-4 lg:h-76 h-full bg-white rounded-md shadow-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center">
                <h1 class="font-semibold text-base text-black capitalize">Daftar Anggota / Pengurus Lainnya</h1>
                <div class="flex w-auto gap-1 justify-end items-center">
                    <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-css-eye class="h-4 w-4 text-white"/>
                    </div>
                    <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </div>
                    <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-bi-trash class="h-4 w-4 text-white"/>
                    </div>
                </div>
            </div>
            
            <div class="flex w-full h-full overflow-hidden">
                <div class="flex xl:w-240 lg:w-183.75 md:w-screen w-74 h-full justify-start items-center gap-4 scrollbar-thin overflow-x-auto p-2 rounded-md">
                    @for ($i = 1; $i <= 8; $i++)
                    <div class="relative flex flex-none flex-col lg:w-38 md:w-32 w-22 lg:h-48 md:h-42 h-42 rounded-md shadow-md hover:scale-105 duration-150 transition-transform ease-in-out bg-white border border-gray-200">
                        <div class="w-full h-[90%] flex items-center justify-center p-2">
                            <img src="{{ asset('img/foto.jpg') }}" alt="Pengurus" class="w-full h-full object-contain rounded-md">
                        </div>
                        <div class="w-full h-[10%] flex flex-col justify-center items-center bg-gray-200 rounded-b-md">
                            <p class="text-black font-semibold text-sm normal-case">Sekretaris</p>
                        </div>
                        <div class="absolute top-0 left-0 w-full h-full bg-gray-400 bg-opacity-90 opacity-0 hover:opacity-90 duration-150 transition-opacity ease-in-out rounded-md z-10">
                            <div class="flex flex-col w-full h-full justify-center items-center gap-2 p-2 whitespace-normal">
                                <p class="font-semibold lg:text-base text-xs text-black normal-case justify-center">Nama Pengurus</p>
                                <p class="text-black font-normal text-xs text-center normal-case">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

            </div>
        </div>
    </article>

</section>