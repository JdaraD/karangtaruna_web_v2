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

<div class="flex flex-col gap-4 w-full h-full">
    {{-- screen media --}}
    <div class="relative flex justify-center overflow-hidden w-full lg:aspect-28/9 md:aspect-24/9 aspect-video">
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
    </div>
    {{-- screen media --}}

    {{-- program Khusus --}}
    <div class="flex flex-col justify-center items-center gap-2 w-full h-full">
        <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Program Karang Taruna</p>
    </div>
    <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-4 w-full h-full mt-4">
        <div class="flex flex-col justify-center items-center gap-2 w-full h-full bg-[#9CB080] rounded-md">
            <img src="{{ asset('img/program1.jpg') }}" alt="" class="w-full h-40 object-cover rounded-t-md">
            <div class="flex flex-col justify-center items-center gap-2 w-full h-full p-4">
                <p class="font-[poppins] font-semibold lg:text-base md:text-base text-sm text-black normal-case">Program 1</p>
                <p class="font-[poppins] font-normal lg:text-sm md:text-sm text-xs text-black normal-case">Deskripsi Program 1</p>
            </div>
        </div>
    </div>
    {{-- program Khusus --}}

</div>