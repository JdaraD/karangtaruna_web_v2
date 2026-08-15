<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'News'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-bi-newspaper class="h-6 w-6" />
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">News</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">

        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-fit p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Event</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <div class="flex w-29 h-6">
                        <input type="date" name="tanggal" id="tanggal" class="w-full h-full text-black">
                    </div>
                    <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 w-full 3xl:max-h-210 3xl:h-full lg:mx-h-124 lg:h-full md:max-h-124 md:h-full h-64 gap-2 p-2 overflow-y-auto scrollbar-none">
                @for ($i = 1; $i <= 12; $i++)
                    <div class="flex w-full h-36.75 gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <div class="flex w-[46%] h-full">
                            <img src="{{ asset('img/foto.jpg') }}" alt="" class="w-full h-32 object-cover rounded-md">
                        </div>
                        <div class="flex w-full h-full flex-col gap-1">
                            <div class="flex gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                                <p class="text-base font-semibold capitalize">Kegiatan CFD</p>
                                <div class="flex gap-1">
                                    <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                        <x-css-eye class="h-4 w-4 text-white"/>
                                    </div>
                                    <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                        <x-bi-trash class="h-4 w-4 text-white"/>
                                    </div>
                                </div>
                            </div>
                            <p class="text-base font-semibold text-justify line-clamp-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora eligendi quibusdam qui iste quisquam facilis commodi, eius eum sed iure, atque vero fugiat dolorem officiis aut aliquam sint natus nostrum.</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </article>

</section>

<script>
    const hariIni = new Date();

    const tahun = hariIni.getFullYear();
    const bulan = String(hariIni.getMonth() + 1).padStart(2, '0');
    const tanggal = String(hariIni.getDate()).padStart(2, '0');

    const formatTanggal = `${tahun}-${bulan}-${tanggal}`;
    document.getElementById('tanggal').value = formatTanggal;
</script>