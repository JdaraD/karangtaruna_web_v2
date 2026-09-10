<?php

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\map;
use App\Models\sponsor;
use App\Models\albumFoto;

new class extends Component
{
    public $map, $sponsor, $albumFoto;

    public function loadMaps()
    {
        $this->map = map::first();
    }

    public function loadSponsor()
    {
        $this->sponsor = sponsor::all();
    }

    public function loadAlbumFoto()
    {
        $this->albumFoto = albumFoto::all();
    }

    public function mount()
    {
        $this->loadMaps();
        $this->loadSponsor();
        $this->loadAlbumFoto();
    }

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
    <section class="flex flex-col items-center w-full h-full py-8 bg-gray-100">

        {{-- Judul --}}
        <article class="flex flex-col items-center gap-2 w-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black">
                Gallery Karang Taruna
            </p>
        </article>


        {{-- Gallery --}}
        <article class="flex justify-center gap-2 w-[80%] h-90 mt-4">

            {{-- ALBUM 1 --}}
            @if (isset($albumFoto[0]) && $albumFoto[0]->coverFoto)
                <a
                    href="{{ route('foto-detail', $albumFoto[0]->id) }}"
                    class="group relative flex w-[26%] h-full overflow-hidden rounded-lg cursor-pointer"
                >
                    <img
                        src="{{ asset('storage/' . $albumFoto[0]->coverFoto->foto) }}"
                        alt="{{ $albumFoto[0]->judul }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    >

                    {{-- Overlay --}}
                    <div
                        class="absolute inset-0 flex items-center justify-center
                            bg-black/0 transition-all duration-300
                            group-hover:bg-black/40"
                    >
                        {{-- Folder Icon --}}
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-12 h-12 text-white opacity-0 scale-75
                                transition-all duration-300
                                group-hover:opacity-100 group-hover:scale-100"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 12.75V6.75A2.25 2.25 0 0 1 4.5 4.5h4.379c.597 0 1.17.237 1.591.659l1.621 1.621h7.409a2.25 2.25 0 0 1 2.25 2.25v3.72M2.25 12.75h19.5m-19.5 0v4.5A2.25 2.25 0 0 0 4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25v-4.5"
                            />
                        </svg>
                    </div>
                </a>
            @else
                <div class="flex w-[26%] h-full bg-gray-300 animate-pulse rounded-lg"></div>
            @endif


            {{-- BAGIAN TENGAH --}}
            <div class="flex flex-col gap-2 w-[48%] h-full">

                {{-- ALBUM 2 & 3 --}}
                <div class="flex gap-2 w-full h-[50%]">

                    {{-- ALBUM 2 --}}
                    @if (isset($albumFoto[1]) && $albumFoto[1]->coverFoto)
                        <a
                            href="{{ route('foto-detail', $albumFoto[1]->id) }}"
                            class="group relative flex w-[60%] h-full overflow-hidden rounded-lg cursor-pointer"
                        >
                            <img
                                src="{{ asset('storage/' . $albumFoto[1]->coverFoto->foto) }}"
                                alt="{{ $albumFoto[1]->judul }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >

                            {{-- Overlay --}}
                            <div
                                class="absolute inset-0 flex items-center justify-center
                                    bg-black/0 transition-all duration-300
                                    group-hover:bg-black/40"
                            >
                                {{-- Folder Icon --}}
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-10 h-10 text-white opacity-0 scale-75
                                        transition-all duration-300
                                        group-hover:opacity-100 group-hover:scale-100"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 12.75V6.75A2.25 2.25 0 0 1 4.5 4.5h4.379c.597 0 1.17.237 1.591.659l1.621 1.621h7.409a2.25 2.25 0 0 1 2.25 2.25v3.72M2.25 12.75h19.5m-19.5 0v4.5A2.25 2.25 0 0 0 4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25v-4.5"
                                    />
                                </svg>
                            </div>
                        </a>
                    @else
                        <div class="flex w-[60%] h-full bg-gray-300 animate-pulse rounded-lg"></div>
                    @endif


                    {{-- ALBUM 3 --}}
                    @if (isset($albumFoto[2]) && $albumFoto[2]->coverFoto)
                        <a
                            href="{{ route('foto-detail', $albumFoto[2]->id) }}"
                            class="group relative flex w-[40%] h-full overflow-hidden rounded-lg cursor-pointer"
                        >
                            <img
                                src="{{ asset('storage/' . $albumFoto[2]->coverFoto->foto) }}"
                                alt="{{ $albumFoto[2]->judul }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >

                            {{-- Overlay --}}
                            <div
                                class="absolute inset-0 flex items-center justify-center
                                    bg-black/0 transition-all duration-300
                                    group-hover:bg-black/40"
                            >
                                {{-- Folder Icon --}}
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-10 h-10 text-white opacity-0 scale-75
                                        transition-all duration-300
                                        group-hover:opacity-100 group-hover:scale-100"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 12.75V6.75A2.25 2.25 0 0 1 4.5 4.5h4.379c.597 0 1.17.237 1.591.659l1.621 1.621h7.409a2.25 2.25 0 0 1 2.25 2.25v3.72M2.25 12.75h19.5m-19.5 0v4.5A2.25 2.25 0 0 0 4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25v-4.5"
                                    />
                                </svg>
                            </div>
                        </a>
                    @else
                        <div class="flex w-[40%] h-full bg-gray-300 animate-pulse rounded-lg"></div>
                    @endif

                </div>


                {{-- ALBUM 4 --}}
                @if (isset($albumFoto[3]) && $albumFoto[3]->coverFoto)
                    <a
                        href="{{ route('foto-detail', $albumFoto[3]->id) }}"
                        class="group relative flex w-full h-[50%] overflow-hidden rounded-lg cursor-pointer"
                    >
                        <img
                            src="{{ asset('storage/' . $albumFoto[3]->coverFoto->foto) }}"
                            alt="{{ $albumFoto[3]->judul }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        >

                        {{-- Overlay --}}
                        <div
                            class="absolute inset-0 flex items-center justify-center
                                bg-black/0 transition-all duration-300
                                group-hover:bg-black/40"
                        >
                            {{-- Folder Icon --}}
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-10 h-10 text-white opacity-0 scale-75
                                    transition-all duration-300
                                    group-hover:opacity-100 group-hover:scale-100"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.25 12.75V6.75A2.25 2.25 0 0 1 4.5 4.5h4.379c.597 0 1.17.237 1.591.659l1.621 1.621h7.409a2.25 2.25 0 0 1 2.25 2.25v3.72M2.25 12.75h19.5m-19.5 0v4.5A2.25 2.25 0 0 0 4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25v-4.5"
                                />
                            </svg>
                        </div>
                    </a>
                @else
                    <div class="flex w-full h-[50%] bg-gray-300 animate-pulse rounded-lg"></div>
                @endif

            </div>


            {{-- ALBUM 5 --}}
            @if (isset($albumFoto[4]) && $albumFoto[4]->coverFoto)
                <a
                    href="{{ route('foto-detail', $albumFoto[4]->id) }}"
                    class="group relative flex w-[26%] h-full overflow-hidden rounded-lg cursor-pointer"
                >
                    <img
                        src="{{ asset('storage/' . $albumFoto[4]->coverFoto->foto) }}"
                        alt="{{ $albumFoto[4]->judul }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    >

                    {{-- Overlay --}}
                    <div
                        class="absolute inset-0 flex items-center justify-center
                            bg-black/0 transition-all duration-300
                            group-hover:bg-black/40"
                    >
                        {{-- Folder Icon --}}
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-12 h-12 text-white opacity-0 scale-75
                                transition-all duration-300
                                group-hover:opacity-100 group-hover:scale-100"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 12.75V6.75A2.25 2.25 0 0 1 4.5 4.5h4.379c.597 0 1.17.237 1.591.659l1.621 1.621h7.409a2.25 2.25 0 0 1 2.25 2.25v3.72M2.25 12.75h19.5m-19.5 0v4.5A2.25 2.25 0 0 0 4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25v-4.5"
                            />
                        </svg>
                    </div>
                </a>
            @else
                <div class="flex w-[26%] h-full bg-gray-300 animate-pulse rounded-lg"></div>
            @endif

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

                    <!-- Form standar HTML/Laravel -->
                    <form action="{{ route('mail.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full h-full">
                        @csrf <!-- Wajib ada untuk keamanan form di Laravel -->
                        
                        <div class="space-y-4 font-[poppins]">
                            <div class="grid grid-cols-[100px_1fr] items-start text-sm gap-0.5">
                                <label for="nama" class="font-semibold">Nama :</label>
                                <input type="text" name="nama" id="nama" class="w-full h-8 border border-[#9CB080] rounded-lg px-2 bg-gray-100" required />
                            </div>
                            <div class="grid grid-cols-[100px_1fr] items-start text-sm gap-0.5">
                                <label for="alamat" class="font-semibold">Alamat :</label>
                                <textarea name="alamat" id="alamat" class="w-full h-22.5 border border-[#9CB080] rounded-lg px-2 py-2 bg-gray-100 resize-none" required></textarea>
                            </div>
                            <div class="grid grid-cols-[100px_1fr] items-start text-sm gap-0.5">
                                <label for="email" class="font-semibold">Email :</label>
                                <input type="email" name="email" id="email" class="w-full h-8 border border-[#9CB080] rounded-lg px-2 bg-gray-100" required />
                            </div>
                            <div class="grid grid-cols-[100px_1fr] items-start text-sm gap-0.5">
                                <label for="no_telp" class="font-semibold">Nomor Hp:</label>
                                <input type="text" name="no_telp" id="no_telp" class="w-full h-8 border border-[#9CB080] rounded-lg px-2 bg-gray-100" oninput="this.value = this.value.replace(/[^0-9]/g, '')" inputmode="numeric required />
                            </div>
                            <div class="grid grid-cols-[100px_1fr] items-start text-sm gap-0.5">
                                <label for="keperluan" class="font-semibold">Keperluan :</label>
                                <input type="text" name="keperluan" id="keperluan" class="w-full h-8 border border-[#9CB080] rounded-lg px-2 bg-gray-100" required />
                            </div>
                            <div class="grid grid-cols-[100px_1fr] items-start text-sm gap-0.5">
                                <label for="tanggal" class="font-semibold">Tanggal :</label>
                                <input type="date" name="tanggal" id="tanggal" class="w-full h-8 border border-[#9CB080] rounded-lg px-2 bg-gray-100" required />
                            </div>
                        </div>

                        <div class="flex flex-col gap-4 justify-between">
                            <div class="flex flex-col gap-2">
                                <label for="detail" class="capitalize font-[poppins] font-semibold text-center">Detail Keperluan</label>
                                <textarea name="detail_keperluan" id="detail" class="w-full h-42 border border-[#9CB080] rounded-lg px-2 py-2 bg-gray-100 resize-none" required></textarea>
                            </div>
                            
                            <!-- Input File PDF -->
                            <div class="flex flex-col gap-1">
                                <label for="file_pdf" class="font-[poppins] font-semibold text-sm">Lampirkan PDF (Opsional)</label>
                                <input type="file" name="file_pdf" id="file_pdf" accept=".pdf" class="text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#9CB080] file:text-white hover:file:bg-[#618764]" />
                                @error('file_pdf') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex justify-end items-center gap-3">
                                <button type="submit" class="bg-[#9CB080] w-30 h-8 rounded-md font-[poppins] font-semibold text-white hover:bg-[#618764] transition cursor-pointer">
                                    Kirim
                                </button>
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
                <div class="flex w-[50%] h-125 bg-white rounded-lg shadow-md overflow-hidden">
                    {!! $map->link_maps ?? '<iframe src="..." width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>' !!}
                </div>
            </div>

        </article>
    </section>
    {{-- Contact --}}

    {{-- sponsorship --}}
    <section class="flex justify-center items-center flex-col bg-gray-100 gap-0.1 w-full h-full py-2 overflow-hidden">
        <div class="flex flex-col justify-center items-center w-full h-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Sponsorship</p>
        </div>

        <div class="flex justify-center gap-4 w-[90%] h-auto max-w-full animate-scroll px-4 py-2 rounded-md">
            @if ($sponsor->isEmpty())
                @for ($i = 1; $i <= 7; $i++)
                    <div class="flex flex-none flex-col justify-center items-center w-28 h-20 bg-white rounded-lg animate-pulse shadow-lg hover:scale-102 transition-transform ease-in-out duration-120">
                    </div>
                @endfor
            @else
                @foreach ($sponsor as $sp)
                    <div class="flex flex-none flex-col justify-center items-center w-auto p-4 h-auto bg-white rounded-lg shadow-lg hover:scale-102 transition-transform ease-in-out duration-120">
                        <img src="{{ asset('storage/' . $sp->image) }}" alt="" class="h-20 w-20 object-cover">
                        <span class="max-w-full text-sm font-semibold text-center text-gray-500 truncate">
                            {{ $sp->name }}
                        </span>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
    {{-- sponsorship --}}

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.duration.500ms class="fixed top-20 right-5 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    {{-- Notifikasi Gagal --}}
    @if (session('gagal'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.duration.500ms class="fixed top-20 right-5 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg" role="alert">
        <span class="block sm:inline">{{ session('gagal') }}</span>
    </div>
    @endif

    {{-- WAJIB DITAMBAHKAN: Notifikasi Error Validasi --}}
    @if ($errors->any())
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition.duration.500ms class="fixed top-20 right-5 z-50 bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded shadow-lg" role="alert">
        <span class="block sm:inline">Format isian salah atau ada yang kosong.</span>
    </div>
    @endif

</section>