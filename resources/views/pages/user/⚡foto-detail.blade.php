<?php

use Livewire\Component;
use App\Models\albumFoto;

new class extends Component
{
    public $fotos, $album;

    public function loadFoto($id)
    {
        $this->album = AlbumFoto::with('fotos')
            ->where('is_active', true)
            ->findOrFail($id);

        $this->fotos = $this->album->fotos;
    }

    public function mount($id)
    {
        $this->loadFoto($id);
    }
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Foto Detail'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full h-full justify-center items-center">

    <article class="flex flex-col lg:w-[90%] md:w-[90%] w-[90%] h-full py-6 gap-6">

        {{-- Header --}}
        <div class="flex w-full h-full gap-2">
            <a
                href="{{ route('foto') }}"
                class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case"
            >
                Foto :
            </a>

            <p class="font-[poppins] font-normal lg:text-2xl md:text-lg text-base normal-case">
                {{ $album->judul }}
            </p>
        </div>


        {{-- Foto --}}
        <div class="flex flex-wrap w-full h-full justify-center items-center lg:gap-4 md:gap-4 gap-2">

            @forelse ($fotos as $foto)

                <div
                    class="flex relative flex-col lg:w-82 md:w-80 w-30 lg:h-60 md:h-58 h-28 bg-gray-300 rounded-lg shadow-md hover:scale-102 transition-transform duration-120 ease-in-out"
                >
                    <div class="flex w-full h-full rounded-t-lg">
                        <img
                            src="{{ asset('storage/' . $foto->foto) }}"
                            alt="{{ $album->judul }}"
                            class="w-full h-full object-cover rounded-t-lg"
                        >
                    </div>
                </div>

            @empty

                <p class="text-gray-500 font-[poppins]">
                    Belum ada foto pada album ini.
                </p>

            @endforelse

        </div>

    </article>

</section>