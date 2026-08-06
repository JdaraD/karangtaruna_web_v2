<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Usaha Mandiri'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full h-full justify-center items-center">
    {{-- screen media --}}
    <article class="relative flex justify-center overflow-hidden w-full lg:aspect-28/9 md:aspect-24/9 aspect-video">
        <div class="flex w-full h-full transition-transform duration-1000 ease-in-out">
            <div class="w-full h-full shrink-0">
                <img src="{{ asset('img/background.jpg') }}" alt="" class="w-full h-full object-cover">

            </div>
        </div>
        <div class="absolute flex gap-2 justify-center items-center bottom-8 w-30 h-10 bg-[#9CB080] opacity-70 z-30 rounded-md">
            <div class="h-4 w-4 rounded-full bg-white shadow-md z-35 hover:scale-110 hover:bg-[#618764] transition-transform ease-in-out duration-120 cursor-pointer"></div>
            <div class="h-4 w-4 rounded-full bg-white shadow-md z-35 hover:scale-110 hover:bg-[#618764] transition-transform ease-in-out duration-120 cursor-pointer"></div>
            <div class="h-4 w-4 rounded-full bg-white shadow-md z-35 hover:scale-110 hover:bg-[#618764] transition-transform ease-in-out duration-120 cursor-pointer"></div>
            <div class="h-4 w-4 rounded-full bg-white shadow-md z-35 hover:scale-110 hover:bg-[#618764] transition-transform ease-in-out duration-120 cursor-pointer"></div>
        </div>
    </article>
    {{-- screen media --}}

    {{-- banner --}}
    <article class="flex w-[80%] h-20 bg-gray-100 rounded-md shadow-md">

    </article>
    {{-- banner --}}

    {{-- product --}}
    <article class="flex flex-col gap-6 w-[90%] h-full pt-6 pb-8">
        
        <div class="flex flex-col gap-2 w-full h-full overflow-hidden">
            <div class="flex items-center gap-2 w-fit h-full text-black hover:text-gray-500">
                <a href="{{ route('kategori-detail') }}" class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Pupuk</a>
                <x-heroicon-o-arrow-left class="w-6 h-6 text-black font-bold" />
            </div>
            <div class="flex w-full h-full scrollbar-thin scrollbar-thumb-black scrollbar-track-gray-200 overflow-y-auto gap-4 py-2 px-2 rounded-lg">
                @for ($i = 1; $i <= 8; $i++)
                    <a href="{{ route('detail-product') }}" class="flex flex-none justify-center items-center w-68 h-40 bg-white rounded-lg shadow-lg hover:scale-102 transition-transform ease-in-out duration-120">
                        <img src="{{ asset('img/mbg.jpg') }}" alt="" class="w-full h-full object-cover rounded-lg">
                    </a>
                @endfor

            </div>
        </div>

        <div class="flex flex-col gap-2 w-full h-full overflow-hidden">
            <div class="flex items-center gap-2 w-fit h-full text-black hover:text-gray-500">
                <a href="{{ route('kategori-detail') }}" class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Alat Pertanian</a>
                <x-heroicon-o-arrow-left class="w-6 h-6 text-black font-bold" />
            </div>
            <div class="flex w-full h-full scrollbar-thin scrollbar-thumb-black scrollbar-track-gray-200 overflow-y-auto gap-4 py-2 px-2 rounded-lg">
                @for ($i = 1; $i <= 8; $i++)
                    <a href="{{ route('detail-product') }}" class="flex flex-none justify-center items-center w-68 h-40 bg-white rounded-lg shadow-lg hover:scale-102 transition-transform ease-in-out duration-120">
                        <img src="{{ asset('img/mbg.jpg') }}" alt="" class="w-full h-full object-cover rounded-lg">
                    </a>
                @endfor

            </div>
        </div>

        <div class="flex flex-col gap-2 w-full h-full overflow-hidden">
            <div class="flex items-center gap-2 w-fit h-full text-black hover:text-gray-500">
                <a href="{{ route('kategori-detail') }}" class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Alat Rumah Tangga</a>
                <x-heroicon-o-arrow-left class="w-6 h-6 text-black font-bold" />
            </div>
            <div class="flex w-full h-full scrollbar-thin scrollbar-thumb-black scrollbar-track-gray-200 overflow-y-auto gap-4 py-2 px-2 rounded-lg">
                @for ($i = 1; $i <= 8; $i++)
                    <a href="{{ route('detail-product') }}" class="flex flex-none justify-center items-center w-68 h-40 bg-white rounded-lg shadow-lg hover:scale-102 transition-transform ease-in-out duration-120">
                        <img src="{{ asset('img/mbg.jpg') }}" alt="" class="w-full h-full object-cover rounded-lg">
                    </a>
                @endfor

            </div>
        </div>

    </article>
    {{-- product --}}
</section>