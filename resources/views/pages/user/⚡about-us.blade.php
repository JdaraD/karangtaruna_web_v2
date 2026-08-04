<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Tentang Kami',
            ]);
    }
};
?>

<section class="flex flex-col w-full h-full justify-center items-center my-6 gap-4">
    <article class="flex flex-col w-[90%] h-full gap-2">
        <h1 class="text-2xl normal-case font-bold">Tentang Kami</h1>
        <div class="flex gap-2 w-full h-full">
            <img src="{{ asset('img/logo.png') }}" alt="" class="w-20 h-24 rounded-full">
            <div class="flex justify-center flex-col gap-1">
                <p class="font-semibold text-base">Karang Taruna</p>
                <p class="text-sm">Desa Waru</p>
            </div>
        </div>

        <div class="flex flex-col gap-2 w-full h-full border border-gray-300 bg-gray-200 shadow-md rounded-md p-4">
            <p class="text-justify lg:text-base md:text-base text-sm">
                Karang Taruna adalah organisasi sosial yang berfokus pada pengembangan dan pemberdayaan pemuda di tingkat desa. Organisasi ini bertujuan untuk meningkatkan kualitas hidup masyarakat melalui berbagai program dan kegiatan yang melibatkan generasi muda. Karang Taruna Desa Waru memiliki visi untuk menciptakan lingkungan yang inklusif, kreatif, dan produktif bagi para pemuda, serta berperan aktif dalam pembangunan desa.

                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi molestias pariatur dolorum! Exercitationem corrupti doloremque aperiam aut cupiditate deleniti beatae labore et sint nisi similique minima est, voluptas veritatis eius!, Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum possimus ex adipisci. Alias obcaecati corporis quidem delectus sed quasi accusantium atque vero magnam quod, esse quos. Ad, excepturi. Illum, ipsa.
            </p>
        </div>
    </article>

    <article class="flex flex-col w-[90%] h-full gap-2 pt-8">
        <div class="flex flex-wrap justify-center lg:gap-4 md:gap-4 gap-y-14 w-full h-full rounded-md p-4">
            <div class="relative flex flex-col justify-center items-center h-full lg:w-[49%] md:w-[49%] w-full">
                <div class="absolute flex justify-center items-center -top-12 w-24 h-24 rounded-full bg-[#2B5748] shadow-md hover:scale-105 transition-transform duration-120 ease-in-out">
                    <p class="font-semibold text-white normal-case text-2xl">Visi</p>
                </div>
                <div class="flex w-full h-full justify-center items-center border border-[#618764] bg-[#9CB080] shadow-md rounded-md pt-8">
                    
                    <ul class="px-4 py-4 flex flex-col gap-3 list-disc">
                        @for ($i = 1; $i <= 5; $i++)
                        <li class="flex items-center gap-3">
                                
                            <div class="w-4 h-4 shrink-0 bg-white rounded-full"></div>
                            <span class="text-white lg:text-base md:text-base text-sm text-justify">Menjadikan pemuda desa Waru sebagai generasi yang berkualitas, berdaya saing, dan berkontribusi positif dalam pembangunan desa.</span>
                        </li>
                        @endfor
                    </ul>
                </div>
            </div>

            <div class="relative flex flex-col justify-center items-center h-full lg:w-[49%] md:w-[49%] w-full">
                <div class="absolute flex justify-center items-center -top-12 w-24 h-24 rounded-full bg-[#2B5748] shadow-md hover:scale-105 transition-transform duration-120 ease-in-out">
                    <p class="font-semibold text-white normal-case text-2xl">Misi</p>
                </div>
                <div class="flex w-full h-full justify-center items-center border border-[#618764] bg-[#9CB080] shadow-md rounded-md pt-8">
                    
                    <ul class="px-4 py-4 flex flex-col gap-3 list-disc">
                        @for ($i = 1; $i <= 5; $i++)
                        <li class="flex items-center gap-3">
                                
                            <div class="w-4 h-4 shrink-0 bg-white rounded-full"></div>
                            <span class="text-white lg:text-base md:text-base text-sm text-justify">Menjadikan pemuda desa Waru sebagai generasi yang berkualitas, berdaya saing, dan berkontribusi positif dalam pembangunan desa.</span>
                        </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </article>

    <article class="flex flex-wrap justify-center w-[90%] h-full gap-6">
        <div class="flex justify-center items-center h-100 lg:w-[49%] md:w-[49%] w-full bg-gray-200 shadow-md rounded-md">
            <img src="{{ asset('img/logo.png') }}" alt="" class="lg:h-80 lg:w-80 md:h-74 md:w-74 w-64 h-64 rounded-full">
        </div>
        <div class="flex flex-col gap-4 px-4 py-4 h-100 lg:w-[49%] md:w-[49%] w-full bg-gray-200 shadow-md rounded-md">
            <div class="flex justify-center items-center">
                <p class="capitalize font-bold font-[poppins] lg:text-xl md:text-xl text-lg">value</p>
            </div>

            @for ( $i =1; $i <= 5; $i++)
                <div class="flex gap-2 mb-2">
                    <p class="capitalize font-bold text-bold font-[poppins] lg:text-sm md:text-sm text-xs">kejujuran</p>
                    <p class="capitalize font-[poppins] lg:text-xs md:text-xs text-[10px] text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            @endfor
            
        </div>

    </article>
</section>