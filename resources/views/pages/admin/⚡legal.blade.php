<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'legal'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-bi-book class="h-5 w-5"/>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Legal</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">
        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Dasar Hukum Karang Taruna Desa</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </div>
                    <button type="button" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                        <x-bi-pencil class="h-4 w-4 text-white"/>
                    </button>
                    <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                        <x-bi-trash class="h-4 w-4 text-white"/>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap">
                <p class="lg:text-base text-sm lg:line-clamp-9 md:line-clamp-8 line-clamp-5 text-black text-justify">Karang Taruna adalah organisasi sosial yang berfokus pada pengembangan dan pemberdayaan pemuda di tingkat desa. Organisasi ini bertujuan untuk meningkatkan kualitas hidup masyarakat melalui berbagai program dan kegiatan yang melibatkan generasi muda. Karang Taruna Desa Waru memiliki visi untuk menciptakan lingkungan yang inklusif, kreatif, dan produktif bagi para pemuda, serta berperan aktif dalam pembangunan desa. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi molestias pariatur dolorum! Exercitationem corrupti doloremque aperiam aut cupiditate deleniti beatae labore et sint nisi similique minima est, voluptas veritatis eius!, Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum possimus ex adipisci. Alias obcaecati corporis quidem delectus sed quasi accusantium atque vero magnam quod, esse quos. Ad, excepturi. Illum, ipsa.</p>

            </div>
        </div>

        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Pasal Tentang Berdirinya Karang Taruna</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                        <x-css-eye class="h-4 w-4 text-white"/>
                    </div>
                    <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </div>
                    <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
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
</section>