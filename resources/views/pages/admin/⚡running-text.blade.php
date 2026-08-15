<?php

use Livewire\Component;

new class extends Component
{
    public $ovelayAdd = false;

    public function btnOpenAdd()
    {
        $this->overlayAdd = true;
    }

    public function closeOpenAdd()
    {
        $this->overlayAdd = false;
    }
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'Running Text'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-gmdi-info class="w-6 h-6"/>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Running Text</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">

        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Running Text</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <button id="btbOpenAdd" name="btnOpenAdd" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 w-full 3xl:h-210 lg:h-80 md:h-66 h-64 gap-2 p-2 overflow-y-auto scrollbar-none">
                @for ($i = 1; $i <= 2; $i++)
                    <div class="flex flex-col w-full h-fit gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <p class="text-base font-semibold capitalize line-clamp-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste adipisci laudantium nam, maxime dicta ea odio. Molestiae, at cumque praesentium ab distinctio, aut quisquam reiciendis, impedit rerum itaque consequatur velit.</p>
                        <div class="flex w-full h-full gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                            <p class="text-base font-semibold capitalize">Berita 1</p>
                            <div class="flex gap-1">
                                <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                    <x-css-eye class="h-4 w-4 text-white"/>
                                </div>
                                <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                    <x-bi-trash class="h-4 w-4 text-white"/>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </article>

    {{-- overlay btn add --}}
    <article id="overlayAdd" name="overlayAdd" class="absolute items-center justify-center top-0 left-0 w-full h-full bg-gray-400/60 z-50">
        <div class="relative flex w-[80%] h-[80%] items-center justify-center bg-white">
            <div id="btnCloseAdd" class="absolute top-2 right-2 rounded-md p-2 bg-amber-200">
                <p>close</p>
            </div>
            <h1 class="text-2xl font-semibold text-black">text</h1>

        </div>
    </article>
    {{-- overlay btn add --}}
    
</section>