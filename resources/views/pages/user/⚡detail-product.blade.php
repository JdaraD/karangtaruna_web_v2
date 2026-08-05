<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Product'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full h-full justify-center items-center">
    {{-- detail Product --}}
    <article class="flex flex-col gap-2 w-[90%] h-full pt-6 pb-8">
        <div class="flex flex-wrap gap-4 w-full h-full">
            <div class="flex flex-col h-full lg:w-[40%] md:w-[40%] w-full justify-center items-center order-1">
                <div class="flex h-90 lg:w-102.5 md:w-90 w-full shrink-0 flex-none bg-gray-300 rounded-md shadow-md animate-pulse"></div>
                <div class="flex gap-2 justify-center items-center w-full h-full mt-2">
                    <div class="flex w-100 h-full py-2 px-4 rounded-md gap-4 bg-gray-200 scrollbar-thin scrollbar-thumb-black scrollbar-track-gray-200 overflow-x-auto">
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="flex h-14 w-20 flex-none shrink-0 bg-[#9CB080] rounded-md shadow-md animate-pulse hover:scale-105 transition-transform ease-in-out duration-120"></div>
                        @endfor

                    </div>

                </div>
            </div>

            <div class="flex h-full lg:w-[58%] md:w-[58%] w-full order-2 flex-col gap-2">
                <div class="flex flex-col gap-2 w-full h-[20%]">
                    <p class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm text-black normal-case">MBG</p>
                    <p class="font-[poppins] font-normal lg:text-lg md:text-base text-sm text-black normal-case">Rp 100.000</p>
                </div>

                <div class="flex flex-col gap-2 w-full h-[60%]">
                    <p class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm text-black normal-case">Deskripsi</p>
                    <div class="flex w-full border border-b-black"></div>

                    <p class="font-[poppins] font-normal lg:text-sm md:text-sm text-xs text-black normal-case text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est magnam provident nobis dolorum quidem fugit facere nesciunt repellendus vero facilis, labore, perferendis accusantium rerum! A id illo fugiat doloribus nostrum!</p>
                </div>

                <div class="flex flex-col gap-2 w-full h-[20%]">
                    <p class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm text-black normal-case">E-commerce</p>
                    <div class="flex w-full border border-b-black"></div>

                    <div class="flex gap-2 justify-center items-center w-full h-full">
                        <a href="#" class="flex px-4 py-4 hover:scale-105 transition-transform ease-in-out duration-120 justify-center items-center bg-[#9CB080] rounded-md shadow-md">
                            <x-si-shopee class="w-8 h-8" />
                        </a>
                        <a href="#" class="flex px-4 py-4 hover:scale-105 transition-transform ease-in-out duration-120 justify-center items-center bg-[#9CB080] rounded-md shadow-md">
                            <x-si-shopee class="w-8 h-8" />
                        </a>
                        <a href="#" class="flex px-4 py-4 hover:scale-105 transition-transform ease-in-out duration-120 justify-center items-center bg-[#9CB080] rounded-md shadow-md">
                            <x-si-shopee class="w-8 h-8" />
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </article>
    {{-- detail Product --}}

    {{-- others product --}}
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
    </article>
    {{-- others product --}}
</section>