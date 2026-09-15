<?php

use Livewire\Component;
use App\Models\albumFoto;

new class extends Component
{
    public $fotos, $album;

    public function loadFoto($id)
    {
        $this->album = albumFoto::with('fotos')
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

<section class="flex flex-col w-full h-full justify-center items-center">

    <article class="flex flex-col lg:w-[90%] md:w-[90%] w-[90%] h-full md:py-6 py-2 md:gap-6 gap-2">

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
        <div class="grid md:grid-cols-4 grid-cols-3 w-full h-full lg:gap-4 md:gap-4 gap-2">

            @forelse ($fotos as $foto)

                <div
                    class="col-span-1 flex relative flex-col lg:w-82 md:w-70 w-28 lg:h-60 md:h-58 h-24 bg-gray-300 rounded-lg shadow-md hover:scale-102 transition-transform duration-120 ease-in-out"
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