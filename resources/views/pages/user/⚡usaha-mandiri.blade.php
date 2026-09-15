<?php

use Livewire\Component;
use App\Models\kategoriUsaha;
use App\Models\banner;
use App\Models\sliderUsaha;

new class extends Component
{
    public $kategoris, $banner, $sliders;

    public function loadKategori()
    {
        $this->kategoris = kategoriUsaha::all();
    }

    public function loadBanner()
    {
        $this->banner = banner::latest()->first();
    }

    public function loadSliderUsaha()
    {
        $this->sliders = sliderUsaha::latest()->take(6)->get();
    }

    public function mount()
    {
        $this->loadKategori();
        $this->loadBanner();
        $this->loadSliderUsaha();
    }
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Usaha Mandiri'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full h-full justify-center items-center">
    {{-- screen media --}}
    <article class="relative flex justify-center overflow-hidden w-full lg:aspect-28/9 md:aspect-24/9 aspect-video">
        <!-- Wrapper Slider (Tambahkan id="slider-container") -->
        <div x-data="{
            currentIndex: 0,
            totalSlides: {{ count($sliders) }},
            interval: null,
            init() {
                if (this.totalSlides > 1) {
                    this.startAutoSlide();
                }
            },
            goToSlide(index) {
                this.currentIndex = (index >= this.totalSlides) ? 0 : (index < 0 ? this.totalSlides - 1 : index);
                this.resetAutoSlide();
            },
            startAutoSlide() {
                this.interval = setInterval(() => {
                    this.currentIndex = (this.currentIndex + 1) % this.totalSlides;
                }, 3000); // 30 detik (Ubah sementara ke 3000 / 3 detik untuk testing)
            },
            resetAutoSlide() {
                clearInterval(this.interval);
                this.startAutoSlide();
            }
        }" class="relative flex justify-center overflow-hidden w-full lg:aspect-28/9 md:aspect-24/9 aspect-video">
            
            <!-- Wrapper Slider -->
            <div class="flex w-full h-full transition-transform duration-1000 ease-in-out" :style="`transform: translateX(-${currentIndex * 100}%)`">
                @foreach($sliders as $index => $slider)
                    <div class="w-full h-full shrink-0">
                        <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->name }}" class="w-full h-full object-cover">
                    </div>
                @endforeach
            </div>

            <!-- Tombol Navigasi / Dots -->
            <div class="absolute flex gap-2 justify-center items-center bottom-8 px-4 h-10 bg-[#9CB080] opacity-70 z-30 rounded-md">
                @foreach($sliders as $index => $slider)
                    <div @click="goToSlide({{ $index }})" 
                        :class="currentIndex === {{ $index }} ? 'bg-[#618764] scale-110' : 'bg-white'"
                        class="h-4 w-4 rounded-full shadow-md z-35 hover:scale-110 hover:bg-[#618764] transition-transform ease-in-out duration-120 cursor-pointer">
                    </div>
                @endforeach
            </div>
        </div>
    </article>
    {{-- screen media --}}

    {{-- banner --}}
    @if (!$banner)
        <article class="flex max-w-300 md:w-full w-[90%] h-20 bg-gray-100 rounded-md shadow-md animate-pulse">
        </article>
    @else
        <article class="flex max-w-300 md:w-full w-[90%] h-20 bg-gray-100 rounded-md shadow-md">
            <img src="{{ asset('storage/' . $banner->image) }}" alt="" class="w-full h-full object-cover rounded-md">
        </article>
    @endif
    {{-- banner --}}

    {{-- product --}}
    <article class="flex flex-col gap-6 w-[90%] h-full pt-6 pb-8">
        
        @foreach ($kategoris as $kategori)
            <div class="flex flex-col gap-2 w-full h-full overflow-hidden">
                <div class="flex items-center gap-2 w-fit h-full text-black hover:text-gray-500">
                    <a href="{{ route('kategori-detail', $kategori->id) }}" class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">{{$kategori->nama_kategori}}</a>
                    <x-heroicon-o-arrow-left class="w-6 h-6 text-black font-bold" />
                </div>
                <div class="flex w-full h-full scrollbar-thin scrollbar-thumb-black scrollbar-track-gray-200 overflow-y-auto gap-4 py-2 px-2 rounded-lg">
                   @foreach ($kategori->products as $product)

                        @php
                            $images = $product->gambar
                                ? json_decode($product->gambar, true)
                                : [];

                            $firstImage = (
                                is_array($images) && count($images) > 0
                            )
                                ? asset('storage/' . $images[0])
                                : asset('img/no-image.jpg');
                        @endphp

                        <a href="{{ route('detail-product', $product->id) }}" class="flex flex-none justify-center items-center md:w-68 md:h-40 w-48 h-28 bg-white rounded-lg shadow-lg hover:scale-102 transition-transform ease-in-out duration-120">
                            <img 
                                src="{{ $firstImage }}"
                                alt="{{ $product->nama_produk }}"
                                class="w-full h-full object-cover rounded-lg"
                            >
                        </a>

                    @endforeach

                </div>
            </div>
        @endforeach

    </article>
    {{-- product --}}
</section>