<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Kolaborasi'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full h-full justify-center items-center">

    <article class="flex flex-col lg:w-[90%] md:w-[90%] w-[90%] h-full py-6 gap-6">
        <h1 class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Kolaborasi</h1>

        <div class="flex flex-wrap w-full h-full justify-center items-center lg:gap-4 md:gap-4 gap-2">
            @for ($i = 1; $i <= 8; $i++)
                <a href="{{ route('foto-detail') }}" class="flex relative flex-col lg:w-82 md:w-80 w-30 lg:h-60 md:h-58 h-28 bg-gray-300 rounded-lg shadow-md hover:scale-102 transition-transform duration-120 ease-in-out">
                    <div class="flex w-full h-full rounded-t-lg">
                        <img src="{{ asset('img/program.jpg') }}" alt="" class="w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="flex absolute bottom-0 w-full lg:h-10 md:h-10 h-6 justify-center items-center bg-gray-400/70 rounded-b-lg">
                        <p class="text-black font-[poppins] lg:text-base md:text-sm text-xs font-semibold">Program 1</p>
                    </div>
                </a>
            @endfor
        </div>

    </article>
</section>