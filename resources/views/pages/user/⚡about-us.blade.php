<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<section class="flex flex-col w-full h-full justify-center items-center my-4 gap-4">
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
            <p class="text-justify text-base">
                Karang Taruna adalah organisasi sosial yang berfokus pada pengembangan dan pemberdayaan pemuda di tingkat desa. Organisasi ini bertujuan untuk meningkatkan kualitas hidup masyarakat melalui berbagai program dan kegiatan yang melibatkan generasi muda. Karang Taruna Desa Waru memiliki visi untuk menciptakan lingkungan yang inklusif, kreatif, dan produktif bagi para pemuda, serta berperan aktif dalam pembangunan desa.

                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi molestias pariatur dolorum! Exercitationem corrupti doloremque aperiam aut cupiditate deleniti beatae labore et sint nisi similique minima est, voluptas veritatis eius!, Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum possimus ex adipisci. Alias obcaecati corporis quidem delectus sed quasi accusantium atque vero magnam quod, esse quos. Ad, excepturi. Illum, ipsa.
            </p>
        </div>
    </article>

    <article class="flex flex-col w-[90%] h-full gap-2 pt-8">
        <div class="flex gap-4 w-full h-full rounded-md p-4">
            <div class="relative flex flex-col justify-center items-center h-full w-[50%]">
                <div class="absolute flex justify-center items-center -top-12 w-24 h-24 rounded-full bg-[#2B5748] shadow-md hover:scale-105 transition-transform duration-120 ease-in-out">
                    <p class="font-semibold text-white normal-case text-2xl">Visi</p>
                </div>
                <div class="flex w-full h-full justify-center items-center border border-[#618764] bg-[#9CB080] shadow-md rounded-md pt-8">
                    
                    <ul class="px-4 py-4 flex flex-col gap-3 list-disc">
                        @for ($i = 1; $i <= 5; $i++)
                        <li class="flex items-center gap-3">
                                
                            <div class="w-4 h-4 shrink-0 bg-white rounded-full"></div>
                            <span class="text-white text-base text-justify">Menjadikan pemuda desa Waru sebagai generasi yang berkualitas, berdaya saing, dan berkontribusi positif dalam pembangunan desa.</span>
                        </li>
                        @endfor
                    </ul>
                </div>
            </div>

            <div class="relative flex flex-col justify-center items-center h-full w-[50%]">
                <div class="absolute flex justify-center items-center -top-12 w-24 h-24 rounded-full bg-[#2B5748] shadow-md hover:scale-105 transition-transform duration-120 ease-in-out">
                    <p class="font-semibold text-white normal-case text-2xl">Misi</p>
                </div>
                <div class="flex w-full h-full justify-center items-center border border-[#618764] bg-[#9CB080] shadow-md rounded-md pt-8">
                    
                    <ul class="px-4 py-4 flex flex-col gap-3 list-disc">
                        @for ($i = 1; $i <= 5; $i++)
                        <li class="flex items-center gap-3">
                                
                            <div class="w-4 h-4 shrink-0 bg-white rounded-full"></div>
                            <span class="text-white text-base text-justify">Menjadikan pemuda desa Waru sebagai generasi yang berkualitas, berdaya saing, dan berkontribusi positif dalam pembangunan desa.</span>
                        </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </article>
</section>