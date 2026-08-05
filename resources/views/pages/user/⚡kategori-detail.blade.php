<?php

use Livewire\Component;

new class extends Component
{
    
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
    {{-- banner --}}
    <article class="flex w-[80%] h-20 bg-gray-100 rounded-md shadow-md mt-6">

    </article>
    {{-- banner --}}

    {{-- product --}}
    <article class="flex flex-col gap-6 w-[90%] h-full pt-6 pb-8">
        
        <div class="flex flex-col gap-2 w-full h-full overflow-hidden">
            <div class="flex items-center gap-2 w-fit h-full text-black hover:text-gray-500">
                <a href="{{ route('kategori-detail') }}" class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Pupuk</a>
                <x-heroicon-o-arrow-left class="w-6 h-6 text-black font-bold" />
            </div>
            <div class="flex flex-wrap w-full h-full gap-4 rounded-lg">
                @for ($i = 1; $i <= 10; $i++)
                    <a href="{{ route('detail-product') }}" class="flex flex-none justify-center items-center w-64 h-40 bg-white rounded-lg shadow-lg hover:scale-102 transition-transform ease-in-out duration-120">
                        <img src="{{ asset('img/mbg.jpg') }}" alt="" class="w-full h-full object-cover rounded-lg">
                    </a>
                @endfor

            </div>
        </div>

    </article>
    {{-- product --}}
</section>