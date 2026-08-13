<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'Kegiatan'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-bi-activity class="h-5 w-5"/>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Kegiatan</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">
        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Kegiatan Karang taruna/h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 w-full h-auto gap-2">
                @for ($i = 1; $i <= 12; $i++)
                    <div class="flex flex-col w-full h-auto gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <div class="flex gap-1 h-[79%]">
                            <img src="{{ asset('img/mbg.jpg') }}" alt="" class="w-44 h-28 rounded-md">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-1">
                                    <p class="text-base font-semibold text-black">Program :</p>
                                    <p class="text-base font-semibold text-black">MBG</p>
                                </div>
                                <p class="text-xs line-clamp-4 text-justify">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae tempore beatae illo officia alias quia ullam odit cumque! Officiis quaerat atque placeat officia corrupti tempora ad natus cupiditate aspernatur facere.</p>
                            </div>
                        </div>
                        <div class="flex w-full h-[20%] gap-1 p-1 justify-end items-center bg-[#618764]/40 rounded-md">
                            <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                <x-css-eye class="h-4 w-4 text-white"/>
                            </div>
                            <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                <x-bi-trash class="h-4 w-4 text-white"/>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </article>

</section>