<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'About-Us'
            ]);

    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    
    <article class="flex flex-none gap-2 items-center">
        <x-bi-building class="h-5 w-5"/>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Tentang Kami</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">

        <div class="flex flex-col justify-stretch items-center lg:w-[36%] w-full gap-2 lg:h-76 h-auto p-4 bg-white rounded-md shadow-md">
            <div class="flex w-full h-auto gap-1 justify-end items-center">
                <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                    <x-css-eye class="h-4 w-4 text-white"/>
                </div>
                <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                    <x-bi-plus class="h-6 w-6 text-white"/>
                </div>
                <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                    <x-bi-trash class="h-4 w-4 text-white"/>
                </div>
            </div>
            <div class="flex justify-center items-center">
                <img src="{{ asset('img/logo.png') }}" alt="" class="w-42 h-44 rounded-md object-cover">
            </div>
            <div class="flex flex-col items-center gap-1">
                <div class="flex items-center gap-1">
                    <h1 class="font-semibold capitalize lg:text-lg md:text-base text-base text-black">Nama Organiasi :</h1>
                    <p class="lg:text-base text-sm text-black">Karang Taruna Desa Waru</p>
                </div>

                <div class="flex items-center gap-1">
                    <h1 class="font-semibold capitalize lg:text-base text-sm text-black">Periode :</h1>
                    <p class="lg:text-sm text-xs text-black">2022-2030</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col justify-stretch gap-2 items-center lg:w-[62.7%] w-full lg:h-76 h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-end items-center">
                <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                    <x-css-eye class="h-4 w-4 text-white"/>
                </div>
                <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                    <x-bi-plus class="h-6 w-6 text-white"/>
                </div>
                <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                    <x-bi-trash class="h-4 w-4 text-white"/>
                </div>
            </div>
            <div class="flex flex-wrap">
                <p class="lg:text-base text-sm lg:line-clamp-9 md:line-clamp-8 line-clamp-5 text-black text-justify">Karang Taruna adalah organisasi sosial yang berfokus pada pengembangan dan pemberdayaan pemuda di tingkat desa. Organisasi ini bertujuan untuk meningkatkan kualitas hidup masyarakat melalui berbagai program dan kegiatan yang melibatkan generasi muda. Karang Taruna Desa Waru memiliki visi untuk menciptakan lingkungan yang inklusif, kreatif, dan produktif bagi para pemuda, serta berperan aktif dalam pembangunan desa. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi molestias pariatur dolorum! Exercitationem corrupti doloremque aperiam aut cupiditate deleniti beatae labore et sint nisi similique minima est, voluptas veritatis eius!, Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum possimus ex adipisci. Alias obcaecati corporis quidem delectus sed quasi accusantium atque vero magnam quod, esse quos. Ad, excepturi. Illum, ipsa.</p>

            </div>
        </div>

    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">

        <div class="flex flex-col justify-stretch items-center lg:w-[49%] w-full gap-2 lg:h-76 h-44 p-4 bg-white rounded-md shadow-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Visi</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-css-eye class="h-4 w-4 text-white"/>
                    </div>
                    <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </div>
                    <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-bi-trash class="h-4 w-4 text-white"/>
                    </div>
                </div>
            </div>

            <div class="flex w-full h-60 overflow-y-auto scrollbar-none">
                    
                <ul class="flex flex-col gap-3 list-disc">
                    @for ($i = 1; $i <= 8; $i++)
                    <li class="flex items-center gap-3">
                        <div class="lg:w-4 w-2 lg:h-4 h-2 shrink-0 bg-[#9CB080] rounded-full"></div>
                        <span class="text-black lg:text-sm text-xs text-justify">Menjadikan pemuda desa Waru sebagai generasi yang berkualitas, berdaya saing, dan berkontribusi positif dalam pembangunan desa.</span>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>

        <div class="flex flex-col justify-stretch items-center lg:w-[49.7%] w-full gap-2 lg:h-76 h-44 p-4 bg-white rounded-md shadow-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Misi</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-css-eye class="h-4 w-4 text-white"/>
                    </div>
                    <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </div>
                    <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-bi-trash class="h-4 w-4 text-white"/>
                    </div>
                </div>
            </div>

            <div class="flex w-full h-60 overflow-y-auto scrollbar-none">
                    
                <ul class="flex flex-col gap-3 list-disc">
                    @for ($i = 1; $i <= 8; $i++)
                    <li class="flex items-center gap-3">
                        <div class="lg:w-4 w-2 lg:h-4 h-2 shrink-0 bg-[#9CB080] rounded-full"></div>
                        <span class="text-black lg:text-sm text-xs text-justify">Menjadikan pemuda desa Waru sebagai generasi yang berkualitas, berdaya saing, dan berkontribusi positif dalam pembangunan desa.</span>
                    </li>
                    @endfor
                </ul>
            </div>

        </div>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">

        <div class="flex flex-col justify-stretch items-center w-full gap-2 lg:h-58 h-44 p-4 bg-white rounded-md shadow-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Value</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-css-eye class="h-4 w-4 text-white"/>
                    </div>
                    <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </div>
                    <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-bi-trash class="h-4 w-4 text-white"/>
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-full h-full overflow-y-auto scrollbar-none">
                    
                @for ( $i =1; $i <= 4; $i++)
                <div class="flex lg:gap-6 gap-2 justify-center">
                    <p class="capitalize text-black font-semibold text-bold font-[poppins] lg:text-base text-xs">kejujuran :</p>
                    <p class="capitalize text-black font-[poppins] lg:text-base text-xs text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            @endfor
            </div>
    </article>
</section>