<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new class extends Component
{

    public function render()
    {
        return $this->view()
            ->layout('Layouts.user');
    }
}
?>

<section class="flex flex-col gap-4 w-full h-full">
    {{-- screen media --}}
    <section class="relative flex justify-center overflow-hidden w-full lg:aspect-28/9 md:aspect-24/9 aspect-video">
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
    </section>
    {{-- screen media --}}

    {{-- program Khusus --}}
    <section class="flex flex-col gap-2 w-full h-full px-6">
        <div class="flex flex-col justify-center items-center gap-2 w-full h-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Program Karang Taruna</p>
        </div>
        <div class="flex flex-wrap justify-center items-center gap-4 w-full h-full px-6 mt-4 max-w-full">
            @for ($i = 1; $i <= 5; $i++)
                <div class="flex relative shrink-0 gap-2 w-full md:w-[calc(50%-8px)] lg:w-[calc(33.33%-11px)] max-w-116.25 h-34 px-2 py-2 justify-center items-center bg-white shadow-md rounded-lg hover:scale-105 transition-transform ease-in-out duration-120">
                    <div class="bg-red-400 w-[52%] h-full rounded-lg overflow-hidden">
                        <img src="{{ asset('img/mbg.jpg') }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col gap-2 w-[48%] h-full">
                        <p class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm text-black normal-case">MBG</p>
                        <p class="font-[poppins] font-normal lg:text-sm md:text-sm text-xs text-black normal-case line-clamp-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est magnam provident nobis dolorum quidem fugit facere nesciunt repellendus vero facilis, labore, perferendis accusantium rerum! A id illo fugiat doloribus nostrum!</p>
                    </div>
                    <div class="absolute flex justify-center items-center top-2 right-2 w-6 h-6 bg-[#9CB080] rounded-full shadow-md hover:scale-110 transition-transform ease-in-out duration-120 cursor-pointer">
                        <x-heroicon-o-arrow-up-right class="w-4 h-4 text-white" />
                    </div>
                </div>
            @endfor
        </div>
    </section>
    {{-- program Khusus --}}

</section>