<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Foto'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full h-full justify-center items-center">

    <article class="flex flex-col w-[90%] h-full py-6 gap-6">
        <h1 class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Foto</h1>

        <div class="flex flex-wrap w-full h-full justify-center items-center gap-4">
            @for ($i = 1; $i <= 8; $i++)
                <div class="flex relative flex-col w-82 h-60 bg-gray-300 rounded-lg shadow-md hover:scale-102 transition-transform duration-120 ease-in-out">
                    <div class="flex w-full h-full rounded-t-lg">
                        <img src="{{ asset('img/program.jpg') }}" alt="" class="w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="flex absolute bottom-0 w-full h-10 justify-center items-center bg-gray-400/70 rounded-b-lg">
                        <p class="text-black font-[poppins] text-base font-semibold">Program 1</p>
                    </div>
                </div>
            @endfor
        </div>

    </article>
</section>