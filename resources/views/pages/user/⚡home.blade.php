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

<section class="flex flex-col w-full h-full">
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
    <section class="flex flex-col gap-2 w-full h-full bg-gray-100 py-8">
        <article class="flex flex-col justify-center items-center gap-2 w-full h-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Program Karang Taruna</p>
        </article>
        <article class="flex flex-wrap justify-center items-center gap-4 w-full h-full px-6 mt-4 max-w-full">
            @for ($i = 1; $i <= 5; $i++)
                <div class="flex relative shrink-0 gap-2 w-full md:w-[calc(50%-8px)] lg:w-[calc(33.33%-11px)] max-w-116.25 h-34 px-2 py-2 justify-center items-center bg-white shadow-md rounded-lg hover:scale-102 transition-transform ease-in-out duration-120">
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
        </article>
    </section>
    {{-- program Khusus --}}

    {{-- Gallery Progress --}}
    <section class="flex flex-col gap-2 w-full h-full bg-gray-200 py-8">
        <article class="flex flex-col justify-center items-center gap-2 w-full h-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Gallery Progress</p>
        </article>
        <article class="flex flex-wrap justify-center items-center gap-4 w-full h-full max-w-full mt-4">
            @for ($i = 1; $i <= 5; $i++)
                <div class="flex flex-col lg:w-105 md:w-105 w-92.5 lg:h-62.25 md:h-57.25 h-54.5 bg-[#F5F5F5] shrink-0 rounded-lg overflow-hidden shadow-md hover:scale-102 transition-transform ease-in-out duration-120">
                    {{-- <img src="{{ asset('img/program.jpg') }}" alt="" class="w-full h-full object-cover"> --}}
                    <div class="flex relative gap-2 px-4 py-4 h-full w-full">
                        <div class="flex w-[34%] h-full rounded-md">
                            <img src="{{ asset('img/program.jpg') }}" alt="" class="w-full h-full object-cover rounded-md">
                        </div>
                        <div class="flex flex-col gap-2 w-[66%] h-full">
                            <p class="uppercase font-bold">bola</p>
                            <p class="text-xs text-justify font-[poppins] line-clamp-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita veritatis qui dignissimos quidem sed? Tempora, recusandae autem. Eligendi consectetur, fugit voluptatibus cupiditate deserunt eum velit ipsa esse dolores sed nulla?. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi labore illum natus quod provident sint impedit voluptates adipisci eveniet, reiciendis doloribus rerum eos veritatis accusantium a aspernatur cum rem voluptatibus.</p>
                        </div>
                        <p class="absolute bottom-0 right-4 text-black text-2xl normal-case font-bold rounded-md">20%</p>
                    </div>
                    <div class="flex justify-center items-center w-full h-[20%] ">
                        <div class="flex w-[90%] h-4 bg-[#9CB080] rounded-full overflow-hidden">
                            <div class="w-[20%] h-full bg-[#618764]"></div>
                        </div>
                    </div>
                </div>
                
            @endfor
        </article>
    </section>
    {{-- Gallery Progress --}}

    {{-- Gallery Karang taruna --}}
    <section class="flex flex-col w-full h-full py-8 bg-gray-100">
        <article class="flex flex-col justify-center items-center gap-2 w-full h-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Gallery Karang Taruna</p>
        </article>

    </section>
    {{-- Gallery Karang taruna --}}

</section>