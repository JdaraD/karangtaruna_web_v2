<?php

use Livewire\Component;
use App\Models\colorWeb;
use App\Models\colorAdmin;
use App\Models\map;

new class extends Component
{
    public $warna_header, $warna_sidebar, $warna_runningText, $warna_footer, $warna_main;
    public $colorWebs, $colorAdmins, $maps;


    // load data
    public function loadColorWeb()
    {
        $this->colorWebs = colorWeb::first();
    }

    public function loadColorAdmin()
    {
        $this->colorAdmins = colorAdmin::first();
    }

    public function loadMaps()
    {
        $this->maps = map::first();
    }
    // load data

    // function mount
    public function mount()
    {
        $this->loadColorWeb();
        $this->loadColorAdmin();
        $this->loadMaps();
    }
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
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Settings</h1>
    </article>

    <!-- Card: Tema Frontend -->
    <div class="bg-white rounded-md p-4 shadow-sm text-gray-800 flex flex-col gap-4 w-full">
        <div class="bg-[#f4f5f7] p-3 rounded-md flex justify-between items-center">
            <h2 class="font-semibold text-sm">Pengaturan Warna Frontend</h2>
        </div>
        <form action="{{ route('admin.colorWeb.store') }}" method="POST" class="flex flex-col gap-5 px-2">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                <!-- Input Color: Header Frontend -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Warna Header</label>
                    <div class="flex items-center gap-2 border border-gray-300 rounded-md p-1.5 focus-within:ring-2 focus-within:ring-[#00c853]">
                        <input type="color" value="{{ $colorWebs->warna_header ?? '#ffffff' }}" class="h-8 w-12 cursor-pointer border-0 p-0 rounded-sm bg-transparent">
                        <input type="text" name="warna_header" value="{{ $colorWebs->warna_header ?? '#ffffff' }}" class="w-full text-sm text-gray-700 focus:outline-none uppercase font-mono" placeholder="#HEXCODE">
                    </div>
                </div>
                <!-- Input Color: Running Text Frontend -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Warna Running Text</label>
                    <div class="flex items-center gap-2 border border-gray-300 rounded-md p-1.5 focus-within:ring-2 focus-within:ring-[#00c853]">
                        <input type="color" value="{{ $colorWebs->warna_runningText ?? '#0f172a' }}" class="h-8 w-12 cursor-pointer border-0 p-0 rounded-sm bg-transparent">
                        <input type="text" name="warna_runningText" value="{{ $colorWebs->warna_runningText ?? '#0f172a' }}" class="w-full text-sm text-gray-700 focus:outline-none uppercase font-mono" placeholder="#HEXCODE">
                    </div>
                </div>
                <!-- Input Color: Footer Frontend -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Warna Footer</label>
                    <div class="flex items-center gap-2 border border-gray-300 rounded-md p-1.5 focus-within:ring-2 focus-within:ring-[#00c853]">
                        <input type="color" value="{{ $colorWebs->warna_footer ?? '#1e293b' }}" class="h-8 w-12 cursor-pointer border-0 p-0 rounded-sm bg-transparent">
                        <input type="text" name="warna_footer" value="{{ $colorWebs->warna_footer ?? '#1e293b' }}" class="w-full text-sm text-gray-700 focus:outline-none uppercase font-mono" placeholder="#HEXCODE">
                    </div>
                </div>
            </div>
            <div class="flex mt-1">
                <button type="submit" class="bg-[#00c853] hover:bg-green-600 text-white font-medium py-1.5 px-4 rounded-md text-sm transition-colors duration-200">
                    Simpan Tema Website
                </button>
            </div>
        </form>
    </div>

    <!-- Card: Tema Backend -->
    <div class="bg-white rounded-md p-4 shadow-sm text-gray-800 flex flex-col gap-4 w-full">
        <div class="bg-[#f4f5f7] p-3 rounded-md flex justify-between items-center">
            <h2 class="font-semibold text-sm">Pengaturan Warna Backend</h2>
        </div>
        <form action="{{ route('admin.colorAdmin.store') }}" method="POST" class="flex flex-col gap-5 px-2">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                <!-- Input Color: Header Backend -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Warna Header</label>
                    <div class="flex items-center gap-2 border border-gray-300 rounded-md p-1.5 focus-within:ring-2 focus-within:ring-[#00c853]">
                        <input type="color" value="{{ $colorAdmins->warna_header ?? '#0b132b' }}" class="h-8 w-12 cursor-pointer border-0 p-0 rounded-sm bg-transparent">
                        <input type="text" name="warna_header" value="{{ $colorAdmins->warna_header ?? '#0b132b' }}" class="w-full text-sm text-gray-700 focus:outline-none uppercase font-mono" placeholder="#HEXCODE">
                    </div>
                </div>
                <!-- Input Color: Sidebar Backend -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Warna Sidebar</label>
                    <div class="flex items-center gap-2 border border-gray-300 rounded-md p-1.5 focus-within:ring-2 focus-within:ring-[#00c853]">
                        <input type="color" value="{{ $colorAdmins->warna_sidebar ?? '#1c2541' }}" class="h-8 w-12 cursor-pointer border-0 p-0 rounded-sm bg-transparent">
                        <input type="text" name="warna_sidebar" value="{{ $colorAdmins->warna_sidebar ?? '#1c2541' }}" class="w-full text-sm text-gray-700 focus:outline-none uppercase font-mono" placeholder="#HEXCODE">
                    </div>
                </div>
                <!-- Input Color: Main Background Backend -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Warna Main (Area Utama)</label>
                    <div class="flex items-center gap-2 border border-gray-300 rounded-md p-1.5 focus-within:ring-2 focus-within:ring-[#00c853]">
                        <input type="color" value="{{ $colorAdmins->warna_main ?? '#f8fafc' }}" class="h-8 w-12 cursor-pointer border-0 p-0 rounded-sm bg-transparent">
                        <input type="text" name="warna_main" value="{{ $colorAdmins->warna_main ?? '#f8fafc' }}" class="w-full text-sm text-gray-700 focus:outline-none uppercase font-mono" placeholder="#HEXCODE">
                    </div>
                </div>
            </div>
            <div class="flex mt-1">
                <button type="submit" class="bg-[#00c853] hover:bg-green-600 text-white font-medium py-1.5 px-4 rounded-md text-sm transition-colors duration-200">
                    Simpan Tema Admin Panel
                </button>
            </div>
        </form>
    </div>

    <!-- Card: Maps -->
    <div class="bg-white rounded-md p-4 shadow-sm text-gray-800 flex flex-col gap-4 w-full">
        <div class="bg-[#f4f5f7] p-3 rounded-md flex justify-between items-center">
            <h2 class="font-semibold text-sm">Pengaturan Maps</h2>
        </div>
        <form action="{{ route('admin.maps.store') }}" method="POST" class="flex flex-col gap-5 px-2">
            @csrf
            <div class="grid grid-cols-1 gap-4 w-full">
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-medium text-gray-700">Maps</label>
                    <!-- Menggunakan value old() atau dari variable data yang dikirim controller -->
                    <input type="text" name="link_maps" value="{{ old('link_maps', $maps->link_maps ?? '') }}" required placeholder="Link Maps" class="col-span-1 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                </div>
            </div>
            <div class="flex mt-1">
                <button type="submit" class="bg-[#00c853] hover:bg-green-600 text-white font-medium py-1.5 px-4 rounded-md text-sm transition-colors duration-200">
                    Simpan Pengaturan Maps
                </button>
            </div>
        </form>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.duration.500ms class="absolute top-2 right-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('gagal'))
        <div class="absolute top-2 right-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ session('gagal') }}</span>
        </div>
    @endif

</section>