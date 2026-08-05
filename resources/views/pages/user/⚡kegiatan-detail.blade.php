<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Kegiatan Detail'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full h-full">
    <article class="flex w-full h-full justify-center items-center pt-6 rounded-md">
        <div class="flex flex-wrap w-[90%] h-full gap-4">
            <div class="flex h-full lg:w-[30%] w-full justify-center items-center order-1">
                <div class="flex h-90 lg:w-102.5 md:w-90 w-full shrink-0 flex-none bg-gray-100 rounded-md shadow-md animate-pulse"></div>
            </div>
            <div class="flex flex-col flex-wrap shrink-0 flex-none gap-2 lg:w-[68%] w-full h-full order-2">
                <p class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm text-black normal-case">MBG</p>
                <p class="font-[poppins] font-normal lg:text-sm md:text-sm text-xs text-black normal-case text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est magnam provident nobis dolorum quidem fugit facere nesciunt repellendus vero facilis, labore, perferendis accusantium rerum! A id illo fugiat doloribus nostrum!</p>
            </div>

        </div>

    </article>

    <article class="flex justify-center items-center flex-col gap-2 w-full h-full py-6 overflow-hidden">
        <div class="flex flex-col justify-center items-center gap-2 w-full h-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Program Karang Taruna</p>
        </div>
        <div class="flex flex-wrap justify-center items-center gap-4 w-full h-full px-6 mt-4 max-w-full">
            @for ($i = 1; $i <= 5; $i++)
                <div class="flex relative shrink-0 gap-2 w-full md:w-[calc(50%-8px)] lg:w-[calc(33.33%-11px)] max-w-116.25 h-34 px-2 py-2 justify-center items-center bg-white shadow-md rounded-lg hover:scale-102 transition-transform ease-in-out duration-120">
                    <div class="bg-red-400 w-[52%] h-full rounded-lg overflow-hidden">
                        <img src="{{ asset('img/mbg.jpg') }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col gap-2 w-[48%] h-full">
                        <p class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm text-black normal-case">MBG</p>
                        <p class="font-[poppins] font-normal lg:text-sm md:text-sm text-xs text-black normal-case line-clamp-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est magnam provident nobis dolorum quidem fugit facere nesciunt repellendus vero facilis, labore, perferendis accusantium rerum! A id illo fugiat doloribus nostrum!</p>
                    </div>
                    <a href="{{ route('kegiatan-detail') }}" class="absolute flex justify-center items-center top-2 right-2 w-6 h-6 bg-[#9CB080] rounded-full shadow-md hover:scale-110 transition-transform ease-in-out duration-120 cursor-pointer">
                        <x-heroicon-o-arrow-up-right class="w-4 h-4 text-white" />
                    </a>
                </div>
            @endfor
        </article>
    </article>

    <article class="flex justify-center items-center flex-col bg-gray-200 gap-2 w-full h-full py-6 overflow-hidden">
        <div class="flex flex-col justify-center items-center gap-2 w-full h-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Sponsorship</p>
        </div>

        <div class="flex justify-center gap-4 w-[90%] h-auto max-w-full mt-4 animate-scroll px-4 py-2 rounded-md">
            @for ($i = 1; $i <= 8; $i++)
                <div class="flex flex-none justify-center items-center w-28 h-20 bg-white animate-pulse rounded-lg shadow-lg hover:scale-102 transition-transform ease-in-out duration-120">
                </div>
            @endfor
        </div>
    </article>
</section>