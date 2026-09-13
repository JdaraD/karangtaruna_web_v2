<?php

use Livewire\Component;
use App\Models\strukturOrg;
use App\Models\anggota;
use App\Models\identity;

new class extends Component
{
    public $struktur, $anggotas, $identity;

    public function loadStruktur()
    {
        $this->struktur = strukturOrg::latest()->first();
    }

    public function loadAnggota()
    {
        $this->anggotas = anggota::all();
    }

    public function loadIdentity()
    {
        $this->identity = identity::latest()->first();
    }

    public function mount()
    {
        $this->loadStruktur();
        $this->loadAnggota();
        $this->loadIdentity();
    }
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Struktur Organisasi'
            ]);
    }
};
?>

<section class="flex flex-col w-full h-full justify-center items-center my-6 gap-4">
    <h1 class="font-[poppins] font-semibold lg:text-2xl md:text-base text-base text-black normal-case">Struktur Organisasi</h1>
    <article class="flex w-[90%] h-100 justify-center">
        @if ($struktur)
            <img src="{{ asset('storage/' . $struktur->image) }}" alt="" class="w-auto h-auto object-cover border border-gray-200 hover:scale-105 duration-120 transition-transform ease-in-out shadow-md rounded-md">
        @endif
    </article>

    <article class="flex flex-col w-[90%] h-full justify-center mt-4 gap-6 bg-gray-200 p-4 rounded-md shadow-md">

        {{-- JUDUL --}}
        <div class="flex flex-col w-full justify-center items-center">
            <p class="font-semibold text-lg normal-case">
                Pengurus Karang Taruna
            </p>

            @if ($identity)
                <p class="text-gray-500 font-normal text-base normal-case">
                    Desa Waru {{ $identity->periode }}
                </p>
            @endif
        </div>


        {{-- ========================================== --}}
        {{-- KETUA --}}
        {{-- ========================================== --}}
        <div class="flex flex-col w-full justify-center items-center gap-3 mt-4">

            <p class="font-semibold text-lg">
                Ketua
            </p>

            <div class="flex justify-center items-center gap-4">

                @foreach ($anggotas->where('jabatan', 'ketua') as $anggota)

                    <div
                        class="relative flex flex-none flex-col
                        lg:w-48 md:w-42 w-32
                        lg:h-68 md:h-62 h-52
                        rounded-md shadow-md
                        hover:scale-105
                        duration-150 transition-transform
                        ease-in-out bg-white"
                    >

                        {{-- FOTO --}}
                        <div class="w-full h-[90%] flex items-center justify-center p-2">
                            <img
                                src="{{ asset('storage/' . $anggota->image) }}"
                                alt="{{ $anggota->nama }}"
                                class="w-full h-full object-contain rounded-md"
                            >
                        </div>

                        {{-- NAMA --}}
                        <div
                            class="w-full h-[10%]
                            flex flex-col justify-center items-center
                            bg-gray-200 rounded-b-md"
                        >
                            <p class="font-semibold text-sm text-center normal-case">
                                {{ $anggota->nama }}
                            </p>
                        </div>

                        {{-- OVERLAY --}}
                        <div
                            class="absolute inset-0
                            bg-gray-400/90
                            opacity-0 hover:opacity-100
                            duration-150 transition-opacity
                            ease-in-out rounded-md z-10"
                        >
                            <div
                                class="flex flex-col w-full h-full
                                justify-center items-center
                                gap-2 p-3"
                            >
                                <p class="font-semibold text-lg text-black text-center">
                                    {{ $anggota->nama }}
                                </p>

                                <p class="text-black text-xs text-center">
                                    {{ $anggota->description }}
                                </p>
                            </div>
                        </div>

                    </div>

                @endforeach

            </div>

        </div>


        {{-- ========================================== --}}
        {{-- WAKIL KETUA --}}
        {{-- ========================================== --}}
        <div class="flex flex-col w-full justify-center items-center gap-3 mt-2">

            <p class="font-semibold text-lg">
                Wakil Ketua
            </p>

            <div class="flex justify-center items-center gap-4">

                @foreach ($anggotas->where('jabatan', 'wakil ketua') as $anggota)

                    <div
                        class="relative flex flex-none flex-col
                        lg:w-48 md:w-42 w-32
                        lg:h-68 md:h-62 h-52
                        rounded-md shadow-md
                        hover:scale-105
                        duration-150 transition-transform
                        ease-in-out bg-white"
                    >

                        <div class="w-full h-[90%] flex items-center justify-center p-2">
                            <img
                                src="{{ asset('storage/' . $anggota->image) }}"
                                alt="{{ $anggota->nama }}"
                                class="w-full h-full object-contain rounded-md"
                            >
                        </div>

                        <div
                            class="w-full h-[10%]
                            flex flex-col justify-center items-center
                            bg-gray-200 rounded-b-md"
                        >
                            <p class="font-semibold text-sm text-center">
                                {{ $anggota->nama }}
                            </p>
                        </div>

                        <div
                            class="absolute inset-0
                            bg-gray-400/90
                            opacity-0 hover:opacity-100
                            duration-150 transition-opacity
                            rounded-md z-10"
                        >
                            <div
                                class="flex flex-col w-full h-full
                                justify-center items-center gap-2 p-3"
                            >
                                <p class="font-semibold text-lg text-black text-center">
                                    {{ $anggota->nama }}
                                </p>

                                <p class="text-black text-xs text-center">
                                    {{ $anggota->description }}
                                </p>
                            </div>
                        </div>

                    </div>

                @endforeach

            </div>

        </div>


        {{-- ========================================== --}}
        {{-- SEKRETARIS & BENDAHARA --}}
        {{-- ========================================== --}}
        <div class="flex flex-wrap w-full justify-center items-start gap-8 mt-2">

            {{-- SEKRETARIS --}}
            <div class="flex flex-col items-center gap-3">

                <p class="font-semibold text-lg">
                    Sekretaris
                </p>

                <div class="flex flex-wrap justify-center gap-4">

                    @foreach ($anggotas->where('jabatan', 'sekertaris') as $anggota)

                        <div
                            class="relative flex flex-none flex-col
                            lg:w-48 md:w-42 w-32
                            lg:h-68 md:h-62 h-52
                            rounded-md shadow-md
                            hover:scale-105
                            duration-150 transition-transform
                            ease-in-out bg-white"
                        >

                            <div class="w-full h-[90%] flex items-center justify-center p-2">
                                <img
                                    src="{{ asset('storage/' . $anggota->image) }}"
                                    alt="{{ $anggota->nama }}"
                                    class="w-full h-full object-contain rounded-md"
                                >
                            </div>

                            <div
                                class="w-full h-[10%]
                                flex justify-center items-center
                                bg-gray-200 rounded-b-md"
                            >
                                <p class="font-semibold text-sm text-center">
                                    {{ $anggota->nama }}
                                </p>
                            </div>

                            <div
                                class="absolute inset-0
                                bg-gray-400/90 opacity-0 hover:opacity-100
                                duration-150 transition-opacity rounded-md z-10"
                            >
                                <div
                                    class="flex flex-col w-full h-full
                                    justify-center items-center gap-2 p-3"
                                >
                                    <p class="font-semibold text-lg text-black text-center">
                                        {{ $anggota->nama }}
                                    </p>

                                    <p class="text-black text-xs text-center">
                                        {{ $anggota->description }}
                                    </p>
                                </div>
                            </div>

                        </div>

                    @endforeach

                </div>
            </div>


            {{-- BENDAHARA --}}
            <div class="flex flex-col items-center gap-3">

                <p class="font-semibold text-lg">
                    Bendahara
                </p>

                <div class="flex flex-wrap justify-center gap-4">

                    @foreach ($anggotas->where('jabatan', 'bendahara') as $anggota)

                        <div
                            class="relative flex flex-none flex-col
                            lg:w-48 md:w-42 w-32
                            lg:h-68 md:h-62 h-52
                            rounded-md shadow-md
                            hover:scale-105
                            duration-150 transition-transform
                            ease-in-out bg-white"
                        >

                            <div class="w-full h-[90%] flex items-center justify-center p-2">
                                <img
                                    src="{{ asset('storage/' . $anggota->image) }}"
                                    alt="{{ $anggota->nama }}"
                                    class="w-full h-full object-contain rounded-md"
                                >
                            </div>

                            <div
                                class="w-full h-[10%]
                                flex justify-center items-center
                                bg-gray-200 rounded-b-md"
                            >
                                <p class="font-semibold text-sm text-center">
                                    {{ $anggota->nama }}
                                </p>
                            </div>

                            <div
                                class="absolute inset-0
                                bg-gray-400/90 opacity-0 hover:opacity-100
                                duration-150 transition-opacity rounded-md z-10"
                            >
                                <div
                                    class="flex flex-col w-full h-full
                                    justify-center items-center gap-2 p-3"
                                >
                                    <p class="font-semibold text-lg text-black text-center">
                                        {{ $anggota->nama }}
                                    </p>

                                    <p class="text-black text-xs text-center">
                                        {{ $anggota->description }}
                                    </p>
                                </div>
                            </div>

                        </div>

                    @endforeach

                </div>
            </div>

        </div>


        {{-- ========================================== --}}
        {{-- WAKIL SEKRETARIS & WAKIL BENDAHARA --}}
        {{-- ========================================== --}}
        <div class="flex flex-wrap w-full justify-center items-start gap-8 mt-2">

            {{-- WAKIL SEKRETARIS --}}
            <div class="flex flex-col items-center gap-3">

                <p class="font-semibold text-lg">
                    Wakil Sekretaris
                </p>

                <div class="flex flex-wrap justify-center gap-4">

                    @foreach ($anggotas->where('jabatan', 'wakil sekertaris') as $anggota)

                        <div
                            class="relative flex flex-none flex-col
                            lg:w-48 md:w-42 w-32
                            lg:h-68 md:h-62 h-52
                            rounded-md shadow-md
                            hover:scale-105
                            duration-150 transition-transform
                            ease-in-out bg-white"
                        >

                            <div class="w-full h-[90%] flex items-center justify-center p-2">
                                <img
                                    src="{{ asset('storage/' . $anggota->image) }}"
                                    alt="{{ $anggota->nama }}"
                                    class="w-full h-full object-contain rounded-md"
                                >
                            </div>

                            <div
                                class="w-full h-[10%]
                                flex justify-center items-center
                                bg-gray-200 rounded-b-md"
                            >
                                <p class="font-semibold text-sm text-center">
                                    {{ $anggota->nama }}
                                </p>
                            </div>

                            <div
                                class="absolute inset-0
                                bg-gray-400/90 opacity-0 hover:opacity-100
                                duration-150 transition-opacity rounded-md z-10"
                            >
                                <div
                                    class="flex flex-col w-full h-full
                                    justify-center items-center gap-2 p-3"
                                >
                                    <p class="font-semibold text-lg text-black text-center">
                                        {{ $anggota->nama }}
                                    </p>

                                    <p class="text-black text-xs text-center">
                                        {{ $anggota->description }}
                                    </p>
                                </div>
                            </div>

                        </div>

                    @endforeach

                </div>
            </div>


            {{-- WAKIL BENDAHARA --}}
            <div class="flex flex-col items-center gap-3">

                <p class="font-semibold text-lg">
                    Wakil Bendahara
                </p>

                <div class="flex flex-wrap justify-center gap-4">

                    @foreach ($anggotas->where('jabatan', 'wakil bendahara') as $anggota)

                        <div
                            class="relative flex flex-none flex-col
                            lg:w-48 md:w-42 w-32
                            lg:h-68 md:h-62 h-52
                            rounded-md shadow-md
                            hover:scale-105
                            duration-150 transition-transform
                            ease-in-out bg-white"
                        >

                            <div class="w-full h-[90%] flex items-center justify-center p-2">
                                <img
                                    src="{{ asset('storage/' . $anggota->image) }}"
                                    alt="{{ $anggota->nama }}"
                                    class="w-full h-full object-contain rounded-md"
                                >
                            </div>

                            <div
                                class="w-full h-[10%]
                                flex justify-center items-center
                                bg-gray-200 rounded-b-md"
                            >
                                <p class="font-semibold text-sm text-center">
                                    {{ $anggota->nama }}
                                </p>
                            </div>

                            <div
                                class="absolute inset-0
                                bg-gray-400/90 opacity-0 hover:opacity-100
                                duration-150 transition-opacity rounded-md z-10"
                            >
                                <div
                                    class="flex flex-col w-full h-full
                                    justify-center items-center gap-2 p-3"
                                >
                                    <p class="font-semibold text-lg text-black text-center">
                                        {{ $anggota->nama }}
                                    </p>

                                    <p class="text-black text-xs text-center">
                                        {{ $anggota->description }}
                                    </p>
                                </div>
                            </div>

                        </div>

                    @endforeach

                </div>
            </div>

        </div>


        {{-- ========================================== --}}
        {{-- ANGGOTA --}}
        {{-- ========================================== --}}
        <div class="flex flex-col w-full items-center gap-3 mt-4">

            <p class="font-semibold text-lg">
                Anggota
            </p>

            <div
                class="flex w-full justify-center items-center gap-4
                scrollbar-thin
                scrollbar-thumb-gray-400
                scrollbar-track-gray-200
                overflow-x-auto
                px-4 py-2 rounded-md"
            >

                @foreach ($anggotas->where('jabatan', 'anggota') as $anggota)

                    <div
                        class="relative flex flex-none flex-col
                        lg:w-48 md:w-42 w-32
                        lg:h-68 md:h-62 h-52
                        rounded-md shadow-md
                        hover:scale-105
                        duration-150 transition-transform
                        ease-in-out bg-white"
                    >

                        <div class="w-full h-[90%] flex items-center justify-center p-2">

                            <img
                                src="{{ asset('storage/' . $anggota->image) }}"
                                alt="{{ $anggota->nama }}"
                                class="w-full h-full object-contain rounded-md"
                            >

                        </div>

                        <div
                            class="w-full h-[10%]
                            flex justify-center items-center
                            bg-gray-200 rounded-b-md"
                        >
                            <p class="font-semibold text-sm text-center">
                                {{ $anggota->nama }}
                            </p>
                        </div>

                        <div
                            class="absolute inset-0
                            bg-gray-400/90 opacity-0 hover:opacity-100
                            duration-150 transition-opacity rounded-md z-10"
                        >
                            <div
                                class="flex flex-col w-full h-full
                                justify-center items-center gap-2 p-3"
                            >

                                <p class="font-semibold text-lg text-black text-center">
                                    {{ $anggota->nama }}
                                </p>

                                <p class="text-black text-xs text-center">
                                    {{ $anggota->description }}
                                </p>

                            </div>
                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </article>
</section>