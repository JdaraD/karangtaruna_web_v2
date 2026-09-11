<?php

use Livewire\Component;
use App\Models\event;

new class extends Component
{
    public $event;

    public function mount($id)
    {
        $this->event = event::findOrFail($id);
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => "Berita : { $this->event->name}"
            ]);
    }
};
?>

<section class="w-full min-h-screen flex flex-col items-center py-6">

    <article class="flex flex-col w-[90%] max-w-6xl gap-6">

        {{-- =====================================================
            BREADCRUMB
        ====================================================== --}}
        <div class="flex flex-wrap items-center gap-2">

            <a
                href="{{ route('event') }}"
                class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm text-gray-500 hover:text-black transition"
            >
                Berita
            </a>

            <span class="text-gray-400">
                /
            </span>

            <p
                class="font-[poppins] font-normal lg:text-lg md:text-base text-sm text-black line-clamp-1"
            >
                {{ $event->name }}
            </p>

        </div>


        {{-- =====================================================
            DETAIL event
        ====================================================== --}}
        <div class="flex flex-col w-full bg-gray-100 rounded-lg shadow-md overflow-hidden">


            {{-- =================================================
                GAMBAR UTAMA
            ================================================== --}}
            {{-- @php
                $images = $event->image
                    ? json_decode($event->image, true)
                    : [];

                $images = is_array($images)
                    ? $images
                    : [];

                $firstImage = !empty($images)
                    ? asset('storage/' . $images[0])
                    : asset('img/no-image.jpg');
            @endphp --}}


            <div class="flex justify-center items-center w-full bg-gray-200">

                <img
                    src="{{ asset('storage/') . $event->image }}"
                    alt="{{ $event->name }}"
                    class="w-full lg:h-125 md:h-100 h-62.5 object-cover"
                >

            </div>


            {{-- =================================================
                CONTENT
            ================================================== --}}
            <div class="flex flex-col w-full gap-4 p-5 lg:p-8">


                {{-- JUDUL --}}
                <h1
                    class="font-[poppins] font-semibold text-black lg:text-3xl md:text-2xl text-xl leading-tight"
                >
                    {{ $event->name }}
                </h1>


                {{-- TANGGAL --}}
                <div class="flex items-center gap-2">

                    <span class="text-gray-400">
                        📅
                    </span>

                    <p
                        class="font-[poppins] text-xs md:text-sm text-gray-500"
                    >
                        {{ \Carbon\Carbon::parse($event->tanggal_publish)->translatedFormat('d F Y') }}
                    </p>

                </div>


                {{-- GARIS --}}
                <div class="w-full border-b border-gray-300"></div>


                {{-- ISI BERITA --}}
                <div
                    class="font-[poppins] text-black text-sm md:text-base leading-relaxed text-justify whitespace-pre-line"
                >
                    {{ $event->isi_berita }}
                </div>

            </div>

        </div>


        {{-- =====================================================
            BUTTON KEMBALI
        ====================================================== --}}
        <div class="flex w-full">

            <a
                href="{{ route('event') }}"
                class="flex justify-center items-center gap-2 px-5 py-3 bg-gray-200 hover:bg-gray-300 rounded-lg shadow-sm transition"
            >

                <span>
                    ←
                </span>

                <span class="font-[poppins] text-sm font-semibold">
                    Kembali ke Berita
                </span>

            </a>

        </div>

    </article>

</section>