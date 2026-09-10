<?php

use Livewire\Component;
use App\Models\albumVideo;

new class extends Component
{
    public $albumVideo;

    public function loadAlbumVideo()
    {
        $this->albumVideo = albumVideo::all();
    }

    public function mount()
    {
        $this->loadAlbumVideo();
    }
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Video'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full h-full justify-center items-center">

    <article class="flex flex-col lg:w-[90%] md:w-[90%] w-[90%] h-full py-6 gap-6">
        <h1 class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Video</h1>

        <div class="flex flex-wrap w-full h-full justify-center items-center lg:gap-4 md:gap-4 gap-2">
            @foreach ($albumVideo as $av)
                <a
                    href="{{ route('video-detail', $av->id) }}"
                    class="group flex relative flex-col lg:w-62 md:w-40 w-30 lg:h-40 md:h-38 h-28 bg-gray-300 rounded-lg shadow-md overflow-hidden hover:scale-102 transition-transform duration-120 ease-in-out"
                >

                    {{-- Nama Album --}}
                    <div class="flex w-full h-full justify-center items-center">
                        <p class="text-black font-[poppins] lg:text-2xl md:text-xl text-base capitalize font-semibold">
                            {{ $av->nama_album }}
                        </p>
                    </div>

                    {{-- Overlay Hover --}}
                    <div
                        class="absolute inset-0 flex justify-center items-center
                            bg-black/0 opacity-0
                            group-hover:bg-black/40
                            group-hover:opacity-100
                            transition-all duration-300"
                    >
                        {{-- Icon Play Video --}}
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                            class="w-14 h-14 text-white scale-75
                                group-hover:scale-100
                                transition-transform duration-300"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm14.03-1.72a.75.75 0 0 1 0 1.44l-4.5 2.25A.75.75 0 0 1 10.5 13.5v-3a.75.75 0 0 1 1.28-.53l4.5 2.25Z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>

                </a>
            @endforeach
        </div>

    </article>
</section>