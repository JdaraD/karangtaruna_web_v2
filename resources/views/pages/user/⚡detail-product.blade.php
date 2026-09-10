<?php

use Livewire\Component;
use App\Models\kategoriUsaha;
use App\Models\product;

new class extends Component
{
    public $kategori, $product;
    
    public function loadProduct($id)
    {
        $this->product = product::with('kategoriUsaha')
            ->findOrFail($id);

        $this->kategori = $this->product->kategoriUsaha;
    }

    public function mount($id)
    {
        $this->loadProduct($id);
    }
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Product'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full h-full justify-center items-center">
    {{-- detail Product --}}
    <article class="flex flex-col gap-2 w-[90%] h-full pt-6 pb-8">

        @php
            $images = $product->gambar
                ? json_decode($product->gambar, true)
                : [];

            $images = is_array($images) ? $images : [];

            $firstImage = !empty($images)
                ? asset('storage/' . $images[0])
                : asset('img/no-image.jpg');
        @endphp


        <div class="flex flex-wrap gap-4 w-full h-full">

            {{-- =========================
                GAMBAR PRODUCT
            ========================== --}}
            <div class="flex flex-col h-full lg:w-[40%] md:w-[40%] w-full justify-center items-center order-1">

                {{-- Gambar utama --}}
                <div class="flex h-90 lg:w-102.5 md:w-90 w-full shrink-0 flex-none bg-gray-300 rounded-md shadow-md overflow-hidden">

                    <img
                        id="main-product-image"
                        src="{{ $firstImage }}"
                        alt="{{ $product->nama_produk }}"
                        class="w-full h-full object-cover transition-opacity duration-200"
                    >

                </div>


                {{-- Thumbnail --}}
                @if (!empty($images))

                    <div class="flex gap-2 justify-center items-center w-full h-full mt-2">

                        <div class="flex w-100 h-full py-2 px-4 rounded-md gap-4 bg-gray-200 scrollbar-thin scrollbar-thumb-black scrollbar-track-gray-200 overflow-x-auto">

                            @foreach ($images as $index => $image)

                                <button
                                    type="button"
                                    onclick="changeProductImage('{{ asset('storage/' . $image) }}')"
                                    class="flex h-14 w-20 flex-none shrink-0 bg-white rounded-md shadow-md overflow-hidden hover:scale-105 transition-transform ease-in-out duration-120 focus:outline-none"
                                >

                                    <img
                                        src="{{ asset('storage/' . $image) }}"
                                        alt="{{ $product->nama_produk }} - {{ $index + 1 }}"
                                        class="w-full h-full object-cover"
                                    >

                                </button>

                            @endforeach

                        </div>

                    </div>

                @endif

            </div>


            {{-- =========================
                INFORMASI PRODUCT
            ========================== --}}
            <div class="flex h-full lg:w-[58%] md:w-[58%] w-full order-2 flex-col gap-2">


                {{-- Nama & Harga --}}
                <div class="flex flex-col gap-2 w-full h-[20%]">

                    <p class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm text-black normal-case">
                        {{ $product->nama_produk }}
                    </p>

                    <p class="font-[poppins] font-normal lg:text-lg md:text-base text-sm text-black normal-case">
                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                    </p>

                    {{-- Kategori --}}
                    @if ($product->kategoriUsaha)
                        <p class="font-[poppins] font-normal text-xs text-gray-500">
                            Kategori:
                            {{ $product->kategoriUsaha->nama_kategori }}
                        </p>
                    @endif

                </div>


                {{-- =========================
                    DESKRIPSI
                ========================== --}}
                <div class="flex flex-col gap-2 w-full h-[60%]">

                    <p class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm text-black normal-case">
                        Deskripsi
                    </p>

                    <div class="flex w-full border border-b-black"></div>

                    <p class="font-[poppins] font-normal lg:text-sm md:text-sm text-xs text-black normal-case text-justify">
                        {{ $product->deskripsi }}
                    </p>

                </div>


                {{-- =========================
                    E-COMMERCE
                ========================== --}}
                <div class="flex flex-col gap-2 w-full h-[20%]">

                    <p class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm text-black normal-case">
                        E-commerce
                    </p>

                    <div class="flex w-full border border-b-black"></div>


                    <div class="flex gap-2 justify-center items-center w-full h-full">

                        @if ($product->{'link-pembelian'})

                            <a
                                href="{{ $product->{'link-pembelian'} }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex px-4 py-4 hover:scale-105 transition-transform ease-in-out duration-120 justify-center items-center bg-[#9CB080] rounded-md shadow-md"
                            >
                                <x-si-shopee class="w-8 h-8" />
                            </a>

                        @else

                            <p class="font-[poppins] text-xs text-gray-500">
                                Link pembelian belum tersedia.
                            </p>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </article>
    {{-- detail Product --}}

</section>

<script>
    window.changeProductImage = function(imageUrl) {
        const mainImage = document.getElementById('main-product-image');

        if (!mainImage) return;

        mainImage.style.opacity = '0';

        setTimeout(() => {
            mainImage.src = imageUrl;
            mainImage.style.opacity = '1';
        }, 150);
    }
</script>