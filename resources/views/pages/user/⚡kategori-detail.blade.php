<?php

use Livewire\Component;
use App\Models\kategoriUsaha;
use App\Models\banner;

new class extends Component
{
    public $kategori, $banner;

    public function loadKategori($id)
    {
        $this->kategori = KategoriUsaha::with('products')->findOrFail($id);
    }

    public function loadBanner()
    {
        $this->banner = banner::latest()->first();
    }

    public function mount($id)
    {
        $this->loadKategori($id);
        $this->loadBanner();
    }
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Kategori'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full h-full justify-center items-center">
    <article class="flex flex-col lg:w-[90%] md:w-[90%] w-[90%] h-full py-6 gap-2">

        <div class="flex w-full h-full gap-2">
            <a
                href="{{ route('usahamandiri') }}"
                class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case"
            >
                Usaha Mandiri :
            </a>

            <p class="font-[poppins] font-normal lg:text-2xl md:text-lg text-base normal-case">
                {{ $kategori->nama_kategori }}
            </p>
        </div>

        {{-- banner --}}
        <div class="flex w-full h-full justify-center items-center">

            @if (!$banner)
                <article class="flex max-w-300 w-full h-20 bg-gray-100 rounded-md shadow-md animate-pulse">
                </article>
            @else
                <article class="flex max-w-300 w-full h-20 bg-gray-100 rounded-md shadow-md">
                    <img src="{{ asset('storage/' . $banner->image) }}" alt="" class="w-full h-full object-cover rounded-md">
                </article>
            @endif

        </div>
        {{-- banner --}}

        {{-- product --}}
        <div class="flex flex-col gap-6 w-[90%] h-full pt-6 pb-8">
            
            <div class="flex flex-col gap-2 w-full h-full overflow-hidden">
                @if ( $kategori )
                    <div class="flex items-center gap-2 w-fit h-full text-black hover:text-gray-500">
                        <p class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">{{$kategori->nama_kategori}}</p>
                        <x-heroicon-o-arrow-left class="w-6 h-6 text-black font-bold" />
                    </div>
                    <div class="flex flex-wrap w-full h-full gap-4 rounded-lg">
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

                            <a href="{{ route('detail-product', $product->id) }}" class="flex flex-none justify-center items-center w-68 h-40 bg-white rounded-lg shadow-lg hover:scale-102 transition-transform ease-in-out duration-120">
                                <img 
                                    src="{{ $firstImage }}"
                                    alt="{{ $product->nama_produk }}"
                                    class="w-full h-full object-cover rounded-lg"
                                >
                            </a>

                        @endforeach

                    </div>
                @endif
            </div>

        </div>
        {{-- product --}}
    </article>
</section>