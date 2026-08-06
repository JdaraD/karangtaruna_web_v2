<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Event'
            ]);
    }
};
?>

<section class="w-full h-full flex justify-center items-center">
    <article class="flex flex-col lg:w-[90%] md:w-[90%] w-[90%] h-full py-6 gap-6">
        <div class="flex flex-col w-full h-full gap-2">
            <h1 class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Event</h1>
            <div class="border border-b-gray-300"></div>
        </div>

        <div class="flex flex-col w-full h-full gap-6">
            @for ($i = 1; $i <= 8; $i++)

            <div class="flex w-full h-full gap-4 bg-gray-100 rounded-lg shadow-md p-4 hover:scale-102 transition-transform duration-120 ease-in-out">
                <div class="flex w-90 h-40 bg-gray-400 animate-pulse rounded-lg">
                    {{-- <img src="" alt="" class="w-full h-full object-cover rounded-lg"> --}}
                    
                </div>

                <div class="flex flex-col w-full h-full gap-2">
                    <h1 class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm normal-case">Event 1</h1>
                    <p class="font-[poppins] lg:text-base md:text-sm text-xs text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>

                </div>
            </div>
            @endfor
        </div>

    </article>
</section>