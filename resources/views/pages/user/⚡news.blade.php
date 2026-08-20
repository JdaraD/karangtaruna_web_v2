<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'News'
            ]);
    }
};
?>

<section class="w-full h-full flex flex-col justify-center items-center py-6 gap-6">
    <article class="flex flex-col w-[90%] h-full gap-2">
        <h1 class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Berita</h1>
        <div class="border border-b-gray-300"></div>
    </article>

    <article class="flex flex-wrap justify-center w-[90%] h-full gap-6">
        <div class="flex flex-col lg:w-[58%] md:w-[58%] w-full h-full gap-6 lg:order-1 md:order-1 order-2">
    
            <div class="flex flex-col w-full h-full gap-6">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="flex w-full h-full gap-4 bg-gray-100 rounded-lg shadow-md p-4 hover:scale-102 transition-transform duration-120 ease-in-out">
                        <div class="flex lg:w-90 md:w-80 w-60 lg:h-40 md:h-30 h-20 bg-gray-400 animate-pulse rounded-lg">
                            {{-- <img src="" alt="" class="w-full h-full object-cover rounded-lg"> --}}
                            
                        </div>
    
                        <div class="flex flex-col w-full h-full gap-2">
                            <h1 class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm normal-case">News 1</h1>
                            <p class="font-[poppins] lg:text-base md:text-sm text-xs text-justify lg:line-clamp-0 md:line-clamp-0 line-clamp-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
    
                        </div>
                    </div>
                @endfor
            </div>
    
        </div>
    
        <div class="flex flex-col lg:w-[39%] md:w-[39%] w-full h-full gap-6 lg:order-2 md:order-2 order-1">
            <div class="flex flex-col w-full h-80 gap-2 bg-gray-300 animate-pulse rounded-lg">
               
            </div>

            <div class="lg:flex md:flex hidden flex-col w-[90%] h-full gap-2">
                <h1 class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm normal-case">Events</h1>
                <div class="border border-b-gray-300"></div>
            </div>

            <div class="lg:flex md:flex hidden flex-col w-full h-full gap-6">
                @for ($i = 1; $i <= 4; $i++)

                <div class="flex w-full h-full gap-4 bg-gray-100 rounded-lg shadow-md p-4 hover:scale-102 transition-transform duration-120 ease-in-out">
                    <div class="flex lg:w-48 md:w-40 w-32 lg:h-20 md:h-16 h-12 bg-gray-400 animate-pulse rounded-lg">
                        {{-- <img src="" alt="" class="w-full h-full object-cover rounded-lg"> --}}
                        
                    </div>

                    <div class="flex flex-col w-full h-full gap-2">
                        <h1 class="font-[poppins] font-semibold lg:text-base md:text-sm text-xs normal-case">Event 1</h1>
                        <p class="font-[poppins] lg:text-base md:text-sm text-xs text-justify lg:line-clamp-0 md:line-clamp-0 line-clamp-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>

                    </div>
                </div>
                @endfor
            </div>

        </div>

    </article>
</section>