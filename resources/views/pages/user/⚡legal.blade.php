<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Dasar Hukum'
            ]);
    }
};
?>

<section class="w-full px-4 sm:px-6 lg:px-8 my-6">
    <article class="w-full max-w-7xl mx-auto flex flex-col gap-6">
        <h1 class="text-xl sm:text-2xl font-bold">Tentang Kami</h1>
        <div class="flex flex-col md:flex-row w-full items-center md:items-start gap-5 md:gap-8">
            <div class="flex justify-center items-center shrink-0">
                <img src="{{ asset('img/logo.png') }}" alt="" class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 object-cover rounded-full">
            </div>
            <div class="flex flex-col w-full gap-2">
                <div>
                    <p class="font-semibold text-base sm:text-lg">Karang Taruna</p>
                    <p class="text-sm sm:text-base text-gray-600">Desa Waru</p>
                </div>
                <p class="text-justify text-sm sm:text-base leading-relaxed">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, accusamus. Non, accusamus blanditiis quidem tempore corrupti similique nobis magni pariatur quasi consectetur! Eligendi ea aliquid itaque dolores ipsam harum facere!. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iure, odit? Sunt exercitationem eveniet enim. Facere, exercitationem ut sint atque minus quo odit necessitatibus quos nam cum blanditiis? Illo, enim repudiandae.
                </p>
            </div>
        </div>
        <div class="w-full flex justify-center">
            <div class="w-full md:w-[90%] lg:w-[80%] flex flex-col border border-[#618764] bg-[#9CB080] shadow-md rounded-md px-4 sm:px-6 md:px-8 py-6 sm:py-8">
                <p class="font-semibold text-base sm:text-lg text-center">Pasal Tentang Hukum Berdirinya Karang Taruna</p>
                <ul class="mt-5 flex flex-col gap-4">
                    @for ($i = 1; $i <= 5; $i++)
                    <li class="flex items-center gap-3">
                            
                        <div class="w-3 h-3 sm:w-4 sm:h-4 shrink-0 bg-white rounded-full"></div>
                        <span class="text-white lg:text-base text-sm text-justify">Menjadikan pemuda desa Waru sebagai generasi yang berkualitas, berdaya saing, dan berkontribusi positif dalam pembangunan desa.</span>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
    </article>
</section>