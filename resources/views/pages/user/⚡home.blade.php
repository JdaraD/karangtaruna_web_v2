<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new class extends Component
{

    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Beranda'
            ]);
    }
}
?>

<section class="flex flex-col w-full h-full">
    {{-- screen media --}}
    <section class="relative flex justify-center overflow-hidden w-full lg:aspect-28/9 md:aspect-24/9 aspect-video">
        <div class="flex w-full h-full transition-transform duration-1000 ease-in-out">
            <div class="w-full h-full shrink-0">
                <img src="{{ asset('img/background.jpg') }}" alt="" class="w-full h-full object-cover">

            </div>
        </div>
        <div class="absolute flex gap-2 justify-center items-center bottom-8 w-30 h-10 bg-[#9CB080] opacity-70 z-30 rounded-md">
            <div class="h-4 w-4 rounded-full bg-white shadow-md z-35 hover:scale-110 hover:bg-[#618764] transition-transform ease-in-out duration-120 cursor-pointer"></div>
            <div class="h-4 w-4 rounded-full bg-white shadow-md z-35 hover:scale-110 hover:bg-[#618764] transition-transform ease-in-out duration-120 cursor-pointer"></div>
            <div class="h-4 w-4 rounded-full bg-white shadow-md z-35 hover:scale-110 hover:bg-[#618764] transition-transform ease-in-out duration-120 cursor-pointer"></div>
            <div class="h-4 w-4 rounded-full bg-white shadow-md z-35 hover:scale-110 hover:bg-[#618764] transition-transform ease-in-out duration-120 cursor-pointer"></div>
        </div>
    </section>
    {{-- screen media --}}

    {{-- program Khusus --}}
    <section class="flex flex-col gap-2 w-full h-full bg-gray-100 py-8">
        <article class="flex flex-col justify-center items-center gap-2 w-full h-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Program Karang Taruna</p>
        </article>
        <article class="flex flex-wrap justify-center items-center gap-4 w-full h-full px-6 mt-4 max-w-full">
            @for ($i = 1; $i <= 5; $i++)
                <div class="flex relative shrink-0 gap-2 w-full md:w-[calc(50%-8px)] lg:w-[calc(33.33%-11px)] max-w-116.25 h-34 px-2 py-2 justify-center items-center bg-white shadow-md rounded-lg hover:scale-102 transition-transform ease-in-out duration-120">
                    <div class="bg-red-400 w-[52%] h-full rounded-lg overflow-hidden">
                        <img src="{{ asset('img/mbg.jpg') }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col gap-2 w-[48%] h-full">
                        <p class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm text-black normal-case">MBG</p>
                        <p class="font-[poppins] font-normal lg:text-sm md:text-sm text-xs text-black normal-case line-clamp-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est magnam provident nobis dolorum quidem fugit facere nesciunt repellendus vero facilis, labore, perferendis accusantium rerum! A id illo fugiat doloribus nostrum!</p>
                    </div>
                    <div class="absolute flex justify-center items-center top-2 right-2 w-6 h-6 bg-[#9CB080] rounded-full shadow-md hover:scale-110 transition-transform ease-in-out duration-120 cursor-pointer">
                        <x-heroicon-o-arrow-up-right class="w-4 h-4 text-white" />
                    </div>
                </div>
            @endfor
        </article>
    </section>
    {{-- program Khusus --}}

    {{-- Gallery Progress --}}
    <section class="flex flex-col gap-2 w-full h-full bg-gray-200 py-8">
        <article class="flex flex-col justify-center items-center gap-2 w-full h-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Gallery Progress</p>
        </article>
        <article class="flex flex-wrap justify-center items-center gap-4 w-full h-full max-w-full mt-4">
            @for ($i = 1; $i <= 5; $i++)
                <div class="flex flex-col lg:w-105 md:w-105 w-92.5 lg:h-62.25 md:h-57.25 h-54.5 bg-[#F5F5F5] shrink-0 rounded-lg overflow-hidden shadow-md hover:scale-102 transition-transform ease-in-out duration-120">
                    {{-- <img src="{{ asset('img/program.jpg') }}" alt="" class="w-full h-full object-cover"> --}}
                    <div class="flex relative gap-2 px-4 py-4 h-full w-full">
                        <div class="flex w-[34%] h-full rounded-md">
                            <img src="{{ asset('img/program.jpg') }}" alt="" class="w-full h-full object-cover rounded-md">
                        </div>
                        <div class="flex flex-col gap-2 w-[66%] h-full">
                            <p class="uppercase font-bold">bola</p>
                            <p class="text-xs text-justify font-[poppins] line-clamp-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita veritatis qui dignissimos quidem sed? Tempora, recusandae autem. Eligendi consectetur, fugit voluptatibus cupiditate deserunt eum velit ipsa esse dolores sed nulla?. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi labore illum natus quod provident sint impedit voluptates adipisci eveniet, reiciendis doloribus rerum eos veritatis accusantium a aspernatur cum rem voluptatibus.</p>
                        </div>
                        <p class="absolute bottom-0 right-4 text-black text-2xl normal-case font-bold rounded-md">20%</p>
                    </div>
                    <div class="flex justify-center items-center w-full h-[20%] ">
                        <div class="flex w-[90%] h-4 bg-[#9CB080] rounded-full overflow-hidden">
                            <div class="w-[20%] h-full bg-[#618764]"></div>
                        </div>
                    </div>
                </div>
                
            @endfor
        </article>
    </section>
    {{-- Gallery Progress --}}

    {{-- Gallery Karang taruna --}}
    <section class="flex flex-col gap-2 justify-center items-center w-full h-full py-8 bg-gray-100">
        <article class="flex flex-col justify-center items-center gap-2 w-full h-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Gallery Karang Taruna</p>
        </article>

        <article class="flex justify-center gap-2 w-[80%] h-90 mt-4">
            <div class="flex w-[26%] h-full bg-gray-300 animate-pulse rounded-lg">
                {{-- <img src="{{ asset('img/program.jpg') }}" alt="" class="w-full h-full object-cover rounded-lg"> --}}
            </div>
            <div class="flex flex-col gap-2 w-[48%] h-full">
                <div class="flex gap-2 w-full h-[50%]">
                    <div class="flex w-[60%] h-full bg-gray-300 animate-pulse rounded-lg"></div>
                    <div class="flex w-[40%] h-full bg-gray-300 animate-pulse rounded-lg"></div>
                </div>
                <div class="flex w-full h-[50%] bg-gray-300 animate-pulse rounded-lg"></div>
            </div>
            <div class="flex w-[26%] h-full bg-gray-300 animate-pulse rounded-lg"></div>
        </article>
    </section>
    {{-- Gallery Karang taruna --}}

    {{-- Contact --}}
    <section class="flex flex-col gap-2 w-full h-full bg-gray-200 py-8">
        <article class="flex flex-col justify-center items-center gap-2 w-full h-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Contact</p>
        </article>

        <article class="flex justify-center items-center gap-2 w-full h-full mt-4">
            <div class="flex gap-4 w-[80%] h-full">
                <diV class="flex flex-col gap-4 w-[50%] h-125">

                    <div class="flex flex-col gap-4 w-full h-[80%] bg-white rounded-lg shadow-md px-4 py-2">
                        <p class="text-center capitalize font-semibold lg:text-lg md:text-base text-sm">hubungi kami</p>

                        <form action="submit" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full h-[80%]">
                            <div class="space-y-4 font-[poppins]">
                                <div class="grid grid-cols-[100px_1fr] items-start text-sm gap-0.5">
                                    <label for="nama" class="font-semibold">Nama :</label>
                                    <input type="text" wire:model.defer="nama" id="nama" class="w-full h-8 border border-[#9CB080] rounded-lg px-2 bg-gray-100" />
                                </div>
                                <div class="grid grid-cols-[100px_1fr] items-start text-sm gap-0.5">
                                    <label for="alamat" class="font-semibold">Alamat :</label>
                                    <textarea wire:model.defer="alamat" id="alamat" class="w-full h-22.5 border border-[#9CB080] rounded-lg px-2 py-2 bg-gray-100 resize-none"></textarea>
                                </div>
                                <div class="grid grid-cols-[100px_1fr] items-start text-sm gap-0.5">
                                    <label for="email" class="font-semibold">Email :</label>
                                    <input type="email" wire:model.defer="email" id="email" class="w-full h-8 border border-[#9CB080] rounded-lg px-2 bg-gray-100" />
                                </div>
                                <div class="grid grid-cols-[100px_1fr] items-start text-sm gap-0.5">
                                    <label for="no_telp" class="font-semibold">Nomor Hp:</label>
                                    <input type="text" wire:model.defer="no_telp" id="no_telp" class="w-full h-8 border border-[#9CB080] rounded-lg px-2 bg-gray-100" />
                                </div>
                                <div class="grid grid-cols-[100px_1fr] items-start text-sm gap-0.5">
                                    <label for="keperluan" class="font-semibold">Keperluan :</label>
                                    <input type="text" wire:model.defer="keperluan" id="keperluan" class="w-full h-8 border border-[#9CB080] rounded-lg px-2 bg-gray-100" />
                                </div>
                                <div class="grid grid-cols-[100px_1fr] items-start text-sm gap-0.5">
                                    <label for="tanggal" class="font-semibold">Tanggal :</label>
                                    <input type="date" wire:model.defer="tanggal" id="tanggal" class="w-full h-8 border border-[#9CB080] rounded-lg px-2 bg-gray-100" />
                                </div>
                            </div>
    
                            <div class="flex flex-col gap-4 justify-between">
                                <div class="flex flex-col gap-2">
                                    <label for="detail" class="capitalize font-[poppins] font-semibold text-center">Detail Keperluan</label>
                                    <textarea wire:model.defer="detail_Keperluan" id="detail" class="w-full h-42 border border-[#9CB080] rounded-lg px-2 py-2 bg-gray-100 resize-none"></textarea>
                                </div>
                                <div class="flex justify-end items-center">
                                    <button type="submit" class="bg-[#9CB080] w-30 h-8 rounded-md font-[poppins] font-semibold text-white hover:bg-[#618764] transition cursor-pointer">Kirim</button>
                                    <span wire:loading wire:target="submit" class="ml-3 text-sm text-gray-600">Mengirim...</span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="flex flex-col justify-center w-full h-[20%] py-2 bg-white rounded-lg shadow-md">
                        <p class="text-center font-semibold text-black text-base ">Sosial Media</p>
                        <div class="flex gap-2 justify-center items-center w-full h-full">
                            <div class="flex justify-center items-center w-10 h-10 border border-[#9CB080] hover:bg-[#9CB080] rounded-full shadow-md hover:scale-110 transition-transform ease-in-out duration-120 cursor-pointer">
                                <x-css-facebook class="w-full h-full py-2 px-2 text-[#618764] hover:text-white" />
                            </div>
                            <div class="flex justify-center items-center w-10 h-10 border border-[#9CB080] hover:bg-[#9CB080] rounded-full shadow-md hover:scale-110 transition-transform ease-in-out duration-120 cursor-pointer">
                                <x-css-instagram class="w-full h-full py-2 px-2 text-[#618764] hover:text-white" />
                            </div>
                            <div class="flex justify-center items-center w-10 h-10 border border-[#9CB080] hover:bg-[#9CB080] rounded-full shadow-md hover:scale-105 transition-transform ease-in-out duration-110 cursor-pointer">
                                <x-css-twitter class="w-full h-full py-2 px-2 text-[#618764] hover:text-white" />
                            </div>

                        </div>
                    </div>
                </diV>
                <div class="flex w-[50%] h-125 bg-white rounded-lg shadow-md">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.8112020884155!2d106.71671107483074!3d-6.418299693572605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e62919a6edfb%3A0x63e7cbc78630da2!2sKantor%20Desa%20Waru!5e0!3m2!1sid!2sid!4v1785483080904!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" class="w-full h-full rounded-lg" allowfullscreen loading="lazy"></iframe>
                </div>
            </div>

        </article>
    </section>
    {{-- Contact --}}

    {{-- sponsorship --}}
    <section class="flex justify-center items-center flex-col gap-2 w-full h-full bg-gray-100 py-8">
        <article class="flex flex-col justify-center items-center gap-2 w-full h-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Sponsorship</p>
        </article>

        <article class="flex justify-center flex-wrap gap-4 w-[90%] h-auto max-w-full mt-4">
            @for ($i = 1; $i <= 10; $i++)
                <div class="flex justify-center items-center w-28 h-20 bg-white animate-pulse rounded-lg shadow-lg hover:scale-102 transition-transform ease-in-out duration-120">
                </div>
            @endfor

        </article>
    </section>
    {{-- sponsorship --}}

</section>