<?php

use Livewire\Component;

new class extends Component
{
    // load data
    // load data

    // function mount
    // function mount

    // function Button
    // function Button

    // add function
    // add function

    // update function
    // update function

    // delete function
    // delete function

    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'Settings'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">

    <!-- Header Section -->
    <article class="flex flex-none gap-2 items-center text-white">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Settings</h1>
    </article>

    <!-- Card: Tema Frontend -->
    <div class="bg-white rounded-md p-4 shadow-sm text-gray-800 flex flex-col gap-4 w-full">
        <div class="bg-[#f4f5f7] p-3 rounded-md flex justify-between items-center">
            <h2 class="font-semibold text-sm">Pengaturan Warna Frontend</h2>
        </div>
        <form class="flex flex-col gap-5 px-2">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                <!-- Input Color: Header Frontend -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Warna Header</label>
                    <div class="flex items-center gap-2 border border-gray-300 rounded-md p-1.5 focus-within:ring-2 focus-within:ring-[#00c853] focus-within:border-transparent transition-all">
                        <input type="color" value="#ffffff" class="h-8 w-12 cursor-pointer border-0 p-0 rounded-sm bg-transparent">
                        <input type="text" value="#ffffff" class="w-full text-sm text-gray-700 focus:outline-none uppercase font-mono" placeholder="#HEXCODE">
                    </div>
                </div>
                <!-- Input Color: Running Text Frontend -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Warna Running Text</label>
                    <div class="flex items-center gap-2 border border-gray-300 rounded-md p-1.5 focus-within:ring-2 focus-within:ring-[#00c853] focus-within:border-transparent transition-all">
                        <input type="color" value="#0f172a" class="h-8 w-12 cursor-pointer border-0 p-0 rounded-sm bg-transparent">
                        <input type="text" value="#0f172a" class="w-full text-sm text-gray-700 focus:outline-none uppercase font-mono" placeholder="#HEXCODE">
                    </div>
                </div>
                <!-- Input Color: Footer Frontend -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Warna Footer</label>
                    <div class="flex items-center gap-2 border border-gray-300 rounded-md p-1.5 focus-within:ring-2 focus-within:ring-[#00c853] focus-within:border-transparent transition-all">
                        <input type="color" value="#1e293b" class="h-8 w-12 cursor-pointer border-0 p-0 rounded-sm bg-transparent">
                        <input type="text" value="#1e293b" class="w-full text-sm text-gray-700 focus:outline-none uppercase font-mono" placeholder="#HEXCODE">
                    </div>
                </div>
            </div>
            <div class="flex mt-1">
                <button type="button" class="bg-[#00c853] hover:bg-green-600 text-white font-medium py-1.5 px-4 rounded-md text-sm transition-colors duration-200">
                    Simpan Tema Frontend
                </button>
            </div>
        </form>
    </div>

    <!-- Card: Tema Backend -->
    <div class="bg-white rounded-md p-4 shadow-sm text-gray-800 flex flex-col gap-4 w-full">
        <div class="bg-[#f4f5f7] p-3 rounded-md flex justify-between items-center">
            <h2 class="font-semibold text-sm">Pengaturan Warna Backend</h2>
        </div>
        <form class="flex flex-col gap-5 px-2">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                <!-- Input Color: Header Backend -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Warna Header</label>
                    <div class="flex items-center gap-2 border border-gray-300 rounded-md p-1.5 focus-within:ring-2 focus-within:ring-[#00c853] focus-within:border-transparent transition-all">
                        <input type="color" value="#0b132b" class="h-8 w-12 cursor-pointer border-0 p-0 rounded-sm bg-transparent">
                        <input type="text" value="#0b132b" class="w-full text-sm text-gray-700 focus:outline-none uppercase font-mono" placeholder="#HEXCODE">
                    </div>
                </div>
                <!-- Input Color: Sidebar Backend -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Warna Sidebar</label>
                    <div class="flex items-center gap-2 border border-gray-300 rounded-md p-1.5 focus-within:ring-2 focus-within:ring-[#00c853] focus-within:border-transparent transition-all">
                        <input type="color" value="#1c2541" class="h-8 w-12 cursor-pointer border-0 p-0 rounded-sm bg-transparent">
                        <input type="text" value="#1c2541" class="w-full text-sm text-gray-700 focus:outline-none uppercase font-mono" placeholder="#HEXCODE">
                    </div>
                </div>
                <!-- Input Color: Main Background Backend -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Warna Main (Area Utama)</label>
                    <div class="flex items-center gap-2 border border-gray-300 rounded-md p-1.5 focus-within:ring-2 focus-within:ring-[#00c853] focus-within:border-transparent transition-all">
                        <input type="color" value="#f8fafc" class="h-8 w-12 cursor-pointer border-0 p-0 rounded-sm bg-transparent">
                        <input type="text" value="#f8fafc" class="w-full text-sm text-gray-700 focus:outline-none uppercase font-mono" placeholder="#HEXCODE">
                    </div>
                </div>
            </div>
            <div class="flex mt-1">
                <button type="button" class="bg-[#00c853] hover:bg-green-600 text-white font-medium py-1.5 px-4 rounded-md text-sm transition-colors duration-200">
                    Simpan Tema Backend
                </button>
            </div>
        </form>
    </div>

</section>