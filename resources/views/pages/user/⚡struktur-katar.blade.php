<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Struktur Organisasi'
            ]);
    }
};
?>

<section class="flex flex-col w-full h-full justify-center items-center my-6 gap-4">
    <h1 class="font-[poppins] font-semibold lg:text-2xl md:text-base text-base text-black normal-case">Struktur Organisasi</h1>
    <article class="flex w-[90%] h-100 justify-center">
        <img src="{{ asset('img/struktur.png') }}" alt="" class="w-auto h-auto object-contain border border-gray-200 hover:scale-105 duration-120 transition-transform ease-in-out shadow-md rounded-md">
    </article>

    <article class="flex flex-col w-[90%] h-full justify-center mt-4 gap-4 bg-gray-200 p-4 rounded-md shadow-md">
        <div class="flex flex-col w-full h-full justify-center items-center">
            <p class="font-semibold text-lg normal-case">Pengurus Karang Taruna</p>
            <p class="text-gray-500 font-normal text-base normal-case">Desa Waru 2023 - 2031</p>
        </div>

        <div class="flex flex-col w-full h-full justify-center items-center mt-4">
            <div class="relative flex flex-col lg:w-48 md:w-42 w-32 lg:h-68 md:h-62 h-52 rounded-md shadow-md hover:scale-105 duration-150 transition-transform ease-in-out bg-white">
                <div class="w-full h-[90%] flex items-center justify-center p-2">
                    <img src="{{ asset('img/foto.jpg') }}" alt="Ketua" class="w-full h-full object-contain rounded-md">
                </div>
                <div class="w-full h-[10%] flex flex-col justify-center items-center bg-gray-200 rounded-b-md">
                    <p class="font-semibold text-lg normal-case">Ketua</p>
                </div>

                <div class="absolute top-0 left-0 w-full h-full bg-gray-400 bg-opacity-90 opacity-0 hover:opacity-90 duration-150 transition-opacity ease-in-out rounded-md">
                    <div class="flex flex-col w-full h-full justify-center items-center gap-2 p-2">
                        <p class="font-semibold text-lg text-black normal-case">Nama Ketua</p>
                        <p class="text-black font-normal text-base text-center normal-case">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
                    </div>
                </div>

            </div>

        </div>

        <div class="flex w-full h-full justify-center items-center mt-4 gap-4 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200 overflow-x-auto px-4 py-2 rounded-md">
            @for ($i = 1; $i <= 6; $i++)
                
            <!-- 2. PERUBAHAN PADA ELEMEN ANAK -->
            <!-- Menambahkan 'flex-none' agar ukuran w-48 tidak menciut/gepeng -->
            <div class="relative flex flex-none flex-col lg:w-48 md:w-42 w-32 lg:h-68 md:h-62 h-52 rounded-md shadow-md hover:scale-105 duration-150 transition-transform ease-in-out bg-white">
                
                <div class="w-full h-[90%] flex items-center justify-center p-2">
                    <img src="{{ asset('img/foto.jpg') }}" alt="Ketua" class="w-full h-full object-contain rounded-md">
                </div>
                
                <div class="w-full h-[10%] flex flex-col justify-center items-center bg-gray-200 rounded-b-md">
                    <p class="font-semibold text-lg normal-case">sekertaris</p>
                </div>

                <!-- Overlay Hover (Tetap Berfungsi Normal) -->
                <div class="absolute top-0 left-0 w-full h-full bg-gray-400 bg-opacity-90 opacity-0 hover:opacity-90 duration-150 transition-opacity ease-in-out rounded-md z-10">
                    <!-- Menambahkan 'whitespace-normal' di sini agar teks Lorem Ipsum tetap turun ke bawah (tidak ikut memanjang ke samping) -->
                    <div class="flex flex-col w-full h-full justify-center items-center gap-2 p-2 whitespace-normal">
                        <p class="font-semibold text-lg text-black normal-case">Nama Ketua</p>
                        <p class="text-black font-normal text-xs text-center normal-case">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
                    </div>
                </div>

            </div>
            @endfor
        </div>

        <div class="flex w-full h-full justify-center items-center mt-4 gap-4 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200 overflow-x-auto px-4 py-2 rounded-md">
            @for ($i = 1; $i <= 6; $i++)
                
            <!-- 2. PERUBAHAN PADA ELEMEN ANAK -->
            <!-- Menambahkan 'flex-none' agar ukuran w-48 tidak menciut/gepeng -->
            <div class="relative flex flex-none flex-col lg:w-48 md:w-42 w-32 lg:h-68 md:h-62 h-52 rounded-md shadow-md hover:scale-105 duration-150 transition-transform ease-in-out bg-white">
                
                <div class="w-full h-[90%] flex items-center justify-center p-2">
                    <img src="{{ asset('img/foto.jpg') }}" alt="Ketua" class="w-full h-full object-contain rounded-md">
                </div>
                
                <div class="w-full h-[10%] flex flex-col justify-center items-center bg-gray-200 rounded-b-md">
                    <p class="font-semibold text-lg normal-case">sekertaris</p>
                </div>

                <!-- Overlay Hover (Tetap Berfungsi Normal) -->
                <div class="absolute top-0 left-0 w-full h-full bg-gray-400 bg-opacity-90 opacity-0 hover:opacity-90 duration-150 transition-opacity ease-in-out rounded-md z-10">
                    <!-- Menambahkan 'whitespace-normal' di sini agar teks Lorem Ipsum tetap turun ke bawah (tidak ikut memanjang ke samping) -->
                    <div class="flex flex-col w-full h-full justify-center items-center gap-2 p-2 whitespace-normal">
                        <p class="font-semibold text-lg text-black normal-case">Nama Ketua</p>
                        <p class="text-black font-normal text-xs text-center normal-case">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
                    </div>
                </div>

            </div>
            @endfor
        </div>

    </article>
</section>