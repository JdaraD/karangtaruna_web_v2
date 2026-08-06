<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Video Detail'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full h-full justify-center items-center">

    <article class="flex flex-col lg:w-[90%] md:w-[90%] w-[90%] h-full py-6 gap-6">
        <div class="flex w-full h-full gap-2">
            <a href="{{ route('video') }}" class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Video :</a>
            <p class="font-[poppins] font-normal lg:text-2xl md:text-lg text-base normal-case">Program 1</p>
        </div>

        <div class="flex flex-wrap w-full h-full justify-center items-center lg:gap-4 md:gap-4 gap-2">
            @for ($i = 1; $i <= 2; $i++)
                <div class="flex relative flex-col lg:w-82 md:w-80 w-30 lg:h-60 md:h-58 h-28 bg-gray-300 rounded-lg shadow-md hover:scale-102 transition-transform duration-120 ease-in-out">
                    <div class="flex w-full h-full rounded-lg">
                        <iframe width="100%" height="100%" class="rounded-lg" src="https://www.youtube.com/embed/HZPwrFfyyWA" title="DI TEMPAT INI GHOST RANGER INDONESIA MELIHAT LANGSUNG WUJUDNYA - KASIH PAHAM BRO" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            @endfor
        </div>

    </article>
</section>