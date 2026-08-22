<?php

use Livewire\Component;

new class extends Component
{

    // load data
    // load data

    // function mount
    // function mount

    // function Button
    // function Button

    // add function
    // add function

    // update function
    // update function

    // delete function
    // delete function
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin',[
                'title' => 'Dashboard'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">

    <article class="flex flex-none gap-2 items-center">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base ">Dashboard</h1>
    </article>

    <article class="flex flex-none gap-4 items-center justify-between w-full">
        @for ($i = 1; $i <= 3; $i++)
        <div class="flex w-full lg:h-34 md:h-30 h-18 bg-gray-300 animate-pulse shadow-lg"></div>
        @endfor
    </article>

    <article class="flex flex-none gap-4 items-center w-full">
        <div class="flex justify-center items-center w-[64%] h-80 bg-gray-300 animate-pulse shadow-lg">
            <p class="text-black">statistik view</p>
        </div>
        <div class="flex justify-center items-center w-[36%] h-80 bg-gray-300 animate-pulse shadow-lg">
            <p class="text-black">profile perusahan</p>
        </div>
    </article>

    <article class="flex flex-none w-full h-100 bg-gray-300 animate-pulse shadow-lg">

    </article>

</section>