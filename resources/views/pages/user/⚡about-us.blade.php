<?php

use Livewire\Component;
use App\Models\identity;
use App\Models\tentang;
use App\Models\visi;
use App\Models\misi;
use App\Models\value;

new class extends Component
{
    public $identity, $tentang, $visis, $misis, $values;

    public function loadIdentity()
    {
        $this->identity = identity::latest()->first();
    }

    public function loadTentang()
    {
        $this->tentang = tentang::latest()->first();
    }

    public function loadVisi()
    {
        $this->visis = visi::all();
    }

    public function loadMisi()
    {
        $this->misis = misi::all();
    }

    public function loadvalue()
    {
        $this->values = value::all();
    }

    public function mount()
    {
        $this->loadIdentity();
        $this->loadTentang();
        $this->loadMisi();
        $this->loadVisi();
        $this->loadvalue();
    }
    
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
        @if (!$identity)
            <div class="flex gap-2 w-full h-full">
            <div alt="" class="w-20 h-24 rounded-full animate-pulse bg-gray-100"></div>
                <div class="flex justify-center flex-col gap-1">
                    <p class="font-semibold text-base">Nama perusahaan / Organisasi</p>
                </div>
            </div>
        @else
            <div class="flex gap-2 w-full h-full">
                <img src="{{ asset('storage/' . $identity->image) }}" alt="" class="w-20 h-24 rounded-full">
                <div class="flex justify-center flex-col gap-1">
                    <p class="font-semibold text-base">{{ $identity->name }}</p>
                </div>
            </div>
        @endif

        @if (!$tentang)
            <div class="flex flex-col gap-2 w-full h-full border border-gray-300 bg-gray-200 shadow-md rounded-md p-4">
                <p class="text-justify lg:text-base md:text-base text-sm">deskripsi perusahaan</p>
            </div>
        @else
            <div class="flex flex-col gap-2 w-full h-full border border-gray-300 bg-gray-200 shadow-md rounded-md p-4">
                <p class="text-justify lg:text-base md:text-base text-sm">{{$tentang->isi}}</p>
            </div>
        @endif
    </article>

    <article class="flex flex-col w-[90%] h-full gap-2 pt-8">
        <div class="flex flex-wrap justify-center lg:gap-4 md:gap-4 gap-y-14 w-full h-full rounded-md p-4">
            <div class="relative flex flex-col justify-center items-center h-full lg:w-[49%] md:w-[49%] w-full">
                <div class="absolute flex justify-center items-center -top-12 w-24 h-24 rounded-full bg-[#2B5748] shadow-md hover:scale-105 transition-transform duration-120 ease-in-out">
                    <p class="font-semibold text-white normal-case text-2xl">Visi</p>
                </div>
                <div class="flex w-full h-full justify-center items-center border border-[#618764] bg-[#9CB080] shadow-md rounded-md pt-8">
                    
                    <ul class="px-4 py-4 flex flex-col gap-3 list-disc">
                        @foreach ($visis as $visi)
                        <li class="flex items-center gap-3">
                                
                            <div class="w-4 h-4 shrink-0 bg-white rounded-full"></div>
                            <span class="text-white lg:text-base md:text-base text-sm text-justify">{{$visi->isi_visi}}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="relative flex flex-col justify-center items-center h-full lg:w-[49%] md:w-[49%] w-full">
                <div class="absolute flex justify-center items-center -top-12 w-24 h-24 rounded-full bg-[#2B5748] shadow-md hover:scale-105 transition-transform duration-120 ease-in-out">
                    <p class="font-semibold text-white normal-case text-2xl">Misi</p>
                </div>
                <div class="flex w-full h-full justify-center items-center border border-[#618764] bg-[#9CB080] shadow-md rounded-md pt-8">
                    
                    <ul class="px-4 py-4 flex flex-col gap-3 list-disc">
                        @foreach ($misis as $misi)
                        <li class="flex items-center gap-3">
                                
                            <div class="w-4 h-4 shrink-0 bg-white rounded-full"></div>
                            <span class="text-white lg:text-base md:text-base text-sm text-justify">{{$misi->isi_misi}}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </article>

    <article class="flex flex-wrap justify-center w-[90%] h-full gap-6">
        <div class="flex justify-center items-center h-100 lg:w-[49%] md:w-[49%] w-full bg-gray-200 shadow-md rounded-md">
            @if (!$identity)
                <div class="lg:h-80 lg:w-80 md:h-74 md:w-74 w-64 h-64 rounded-full bg-gray-100 animate-pulse"></div>
            @else
                <img src="{{ asset('storage/' . $identity->image) }}" alt="" class="lg:h-86 lg:w-80 md:h-80 md:w-74 w-70 h-64 rounded-full">
            @endif
        </div>
        <div class="flex flex-col gap-4 px-4 py-4 h-100 lg:w-[49%] md:w-[49%] w-full bg-gray-200 shadow-md rounded-md">
            <div class="flex justify-center items-center">
                <p class="capitalize font-bold font-[poppins] lg:text-xl md:text-xl text-lg">value</p>
            </div>

            @foreach ( $values as $value)
                <div class="flex gap-2 mb-2">
                    <p class="capitalize font-bold text-bold font-[poppins] lg:text-sm md:text-sm text-xs">{{$value->name}}</p>
                    <p class="capitalize font-[poppins] lg:text-xs md:text-xs text-[10px] text-justify">{{$value->isi_value}}</p>
                </div>
            @endforeach
            
        </div>

    </article>
</section>