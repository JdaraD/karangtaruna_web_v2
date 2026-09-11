<?php

use Livewire\Component;
use App\Models\event;

new class extends Component
{
    public $event;

    public function loadEvent()
    {
        $this->event = event::all();
    }

    public function mount()
    {
        $this->loadEvent();
    }
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Event'
            ]);
    }
};
?>

<section class="w-full h-full flex justify-center items-center">
    <article class="flex flex-col lg:w-[90%] md:w-[90%] w-[90%] h-full py-6 gap-6">
        <div class="flex flex-col w-full h-full gap-2">
            <h1 class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Event</h1>
            <div class="border border-b-gray-300"></div>
        </div>

        <div class="flex flex-col w-full h-full gap-6">
            @foreach ($event as $et)

            <a href="{{ route('detail-event', $et->id) }}" class="flex w-full h-full gap-4 bg-gray-100 rounded-lg shadow-md p-4 hover:scale-102 transition-transform duration-120 ease-in-out">
                <div class="flex w-90 h-40 bg-gray-400 animate-pulse rounded-lg">
                    <img src="{{ asset('storage/' . $et->gambar) }}" alt="" class="w-full h-full object-cover rounded-lg">
                    
                </div>

                <div class="flex flex-col w-full h-full gap-2">
                    <h1 class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm normal-case">{{ $et->judul }}</h1>
                    <p class="font-[poppins] lg:text-base md:text-sm text-xs text-justify line-clamp-5">{{ $et->deskripsi }}</p>

                </div>
            </a>
            @endforeach
        </div>

    </article>
</section>