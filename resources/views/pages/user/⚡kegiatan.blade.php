<?php

use Livewire\Component;
use App\Models\kegiatan;
use App\Models\sponsor;

new class extends Component
{
    public $kegiatans, $sponsor;

    public function loadKegiatan()
    {
        $this->kegiatans = kegiatan::all();
    }

    public function loadSponsor()
    {
        $this->sponsor = sponsor::all();
    }

    public function mount()
    {
        $this->loadKegiatan();
        $this->loadSponsor();
    }
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Kegiatan'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full h-full justify-center items-center">
    <article class="flex flex-col gap-2 lg:w-[90%] md:w-[90%] w-[90%] h-full py-6 overflow-hidden">
        <h1 class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Kegiatan</h1>

        <div class="flex flex-col justify-center items-center gap-2 w-full h-full">
            <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base text-black normal-case">Program Karang Taruna</p>
        </div>
        <div class="flex flex-wrap justify-center items-center gap-4 w-full h-full px-6 mt-4 max-w-full">
            @foreach ($kegiatans as $kegiatan)
                <div class="flex relative shrink-0 gap-2 w-full md:w-[calc(50%-8px)] lg:w-[calc(33.33%-11px)] max-w-116.25 h-34 px-2 py-2 justify-center items-center bg-white shadow-md rounded-lg hover:scale-102 transition-transform ease-in-out duration-120">
                    <div class="bg-red-400 w-[52%] h-full rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col gap-2 w-[48%] h-full">
                        <p class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm text-black normal-case">{{ $kegiatan->judul }}</p>
                        <p class="font-[poppins] font-normal lg:text-sm md:text-sm text-xs text-black normal-case line-clamp-3">{{ $kegiatan->deskripsi }}</p>
                    </div>
                    <a href="{{ route('kegiatan-detail' , $kegiatan->id) }}" class="absolute flex justify-center items-center top-2 right-2 w-6 h-6 bg-[#9CB080] rounded-full shadow-md hover:scale-110 transition-transform ease-in-out duration-120 cursor-pointer">
                        <x-heroicon-o-arrow-up-right class="w-4 h-4 text-white" />
                    </a>
                </div>
            @endforeach
        </article>
    </article>

    <article class="flex justify-center items-center flex-col bg-gray-200 gap-0.1 w-full h-full py-2 overflow-hidden">
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
    </article>
</section>