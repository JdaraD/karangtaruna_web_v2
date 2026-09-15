<?php

use Livewire\Component;
use App\Models\albumFoto;

new class extends Component
{
    public $albumFoto;

    public function loadAlbumFoto()
    {
        $this->albumFoto = albumFoto::all();
    }

    public function mount()
    {
        $this->loadAlbumFoto();
    }
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Foto'
            ]);
    }
};
?>

<section class="flex flex-col w-full h-full justify-center items-center">

    <article class="flex flex-col lg:w-[90%] md:w-[90%] w-[90%] h-full md:py-6 py-2 md:gap-6 gap-2">
        <h1 class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Foto</h1>

        <div class="grid md:grid-cols-4 grid-cols-3 w-full h-full lg:gap-4 md:gap-4 gap-2">
            @foreach ($albumFoto as $ab)
                <a href="{{ route('foto-detail', $ab->id) }}" class="col-span-1 flex relative flex-col lg:w-82 md:w-70 w-28 lg:h-60 md:h-58 h-24 bg-gray-300 rounded-lg shadow-md hover:scale-102 transition-transform duration-120 ease-in-out">
                    <div class="flex w-full h-full rounded-t-lg">
                        <img src="{{ asset('storage/'. $ab->coverFoto->foto) }}" alt="" class="w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="flex absolute bottom-0 w-full lg:h-10 md:h-10 h-6 justify-center items-center bg-gray-400/70 rounded-b-lg">
                        <p class="text-black font-[poppins] lg:text-base md:text-sm text-xs font-semibold">{{$ab->judul}}</p>
                    </div>
                </a>
            @endforeach
        </div>

    </article>
</section>